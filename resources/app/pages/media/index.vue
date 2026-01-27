<script setup lang="ts">
import { ref, onMounted, computed, watch, h, nextTick } from "vue";
import { useAppOptionStore } from "@/stores/app-option";
import { Icon } from "@iconify/vue";
import AppLayout from "@/components/app/AppLayout.vue";
import TreeView from "@/components/app/TreeView.vue";
import moment from "moment";
import FileManagerService from "@/services/filemanager-service";
import { usePopoverInit } from "@/composables/UseProverInit";
import Upload from "./upload.vue";

const appOption = useAppOptionStore();
interface Node {
  name: string;
  path: string;
  // untuk file
  size?: number;
  last_modified?: string;
  mime_type?: string;
  url?: string;
  is_new?: boolean;

  // untuk folder
  files?: Node[];
  directories?: Node[];
}
const newFolder = ref<Node | null>(null);
const folderInput = ref(null);
const clickNode = ref(null);

// raw data
const raw = ref<Node>({ name: "uploads", path: "/", directories: [] });
const isLoading = ref(false);
const isGrid = ref(true);
const errorRef = ref("");

const selectedNode = ref<Node | null>(null);

const checkedAll = ref(false);
const checkedItems = ref<string[]>([]);
const onEdit = ref<any>("");

function onSelectedNode(node: Node) {
  selectedNode.value = node;
  newFolder.value = null;
  errorRef.value = "";
}
function removeLastSegment(path: string): string {
  return path.split("/").slice(0, -1).join("/");
}

// gabungkan files + directories jadi satu array
// gabungkan files + directories jadi satu array
const mixedItems = computed(() => {
  if (!selectedNode.value) return [];

  const files =
    selectedNode.value.files?.map((f) => ({ ...f, type: "file" as const })) ??
    [];
  const dirs =
    selectedNode.value.directories?.map((d) => ({
      ...d,
      type: "folder" as const,
    })) ?? [];

  return [...files, ...dirs];
});

usePopoverInit([mixedItems]);

// lifecycle
onMounted(() => {
  selectedNode.value = raw.value;
  appOption.appContentFullHeight = true;
  appOption.appContentClass = "d-flex flex-column";

  const fileHasSubNodes = document.querySelectorAll(".file-node.has-sub");
  fileHasSubNodes.forEach((node) => {
    const fileArrow = node.querySelector(".file-link > .file-arrow");
    fileArrow?.addEventListener("click", (event) => {
      event.preventDefault();
      node.classList.toggle("expand");
    });
  });

  const fileInfoNodes = document.querySelectorAll(".file-node");
  fileInfoNodes.forEach((node) => {
    const fileInfo = node.querySelector(".file-link > .file-info");
    fileInfo?.addEventListener("click", (event) => {
      event.preventDefault();
      fileInfoNodes.forEach((otherNode) => {
        if (otherNode !== node) {
          otherNode.classList.remove("selected");
        }
      });
      node.classList.add("expand");
      node.classList.add("selected");
    });
  });

  getData();
});

function addNewFolder() {
  newFolder.value = { name: "New Folder", path: selectedNode.value.path };
  selectedNode.value.directories.push({
    ...newFolder.value,
    is_new: true,
  });

  nextTick(() => {
    // focus the last input
    const lastIndex = folderInput.value.length - 1;
    folderInput.value[lastIndex]?.focus();
  });
}
function handdleEdit(v: string) {
  onEdit.value = v;
  nextTick(() => {
    folderInput.value?.focus();
  });
}

function clearData() {
  newFolder.value = null;
  selectedNode.value = null;
}
async function newFolderSubmit(name: string, path: string) {
  try {
    await FileManagerService.createDir(path, name);
    await getData2();

    const index = selectedNode.value.directories.findIndex(
      (p) => p.path == path
    );
    selectedNode.value.directories[index].is_new = false;
    selectedNode.value.directories[index].name = name;
    selectedNode.value.directories[index].path = path;
    selectedNode.value.directories[index].directories = [];
    checkedItems.value = [];
  } catch (error) {}
}

async function getData() {
  try {
    isLoading.value = true;
    const data = await FileManagerService.getAll();
    raw.value = data;
    selectedNode.value = raw.value;

    isLoading.value = false;
  } catch (error) {
    alert(JSON.stringify(error));
  }
}
async function getData2() {
  try {
    isLoading.value = true;
    const data = await FileManagerService.getAll();
    raw.value = data;

    isLoading.value = false;
  } catch (error) {
    alert(JSON.stringify(error));
  }
}

const fileManager = ref<HTMLElement | null>(null);

function toggleSidebarClass() {
  if (fileManager.value) {
    fileManager.value.classList.toggle("file-manager-sidebar-mobile-toggled");
  }
}

function toggleAll() {
  checkedItems.value = mixedItems.value.map((item) => item.path);
}
function unToggleAll() {
  checkedItems.value = [];
}

async function bulkDelete() {
  console.log("Deleting:", checkedItems.value);

  try {
    // map each checked item into a delete request
    const promises = checkedItems.value.map((item) =>
      FileManagerService.deleteDir(item)
    );

    // wait until all requests finish
    await Promise.all(promises);

    selectedNode.value.directories = selectedNode.value.directories.filter(
      (dir) => !checkedItems.value.includes(dir.path)
    );
    checkedItems.value = [];

    // optionally emit event or refresh UI
  } catch (error) {
    console.error("Error deleting:", error);
  }
}

function bulkDownload() {
  console.log("Downloading:", checkedItems.value);
  // TODO: trigger download logic
}

function bulkMove() {
  console.log("Moving:", checkedItems.value);
  // TODO: open modal or move dialog
}

watch(checkedItems, (newVal) => {
  checkedAll.value = newVal.length === mixedItems.value.length;
});

const popoverContent = (item: Node) =>
  `<ul>
      <li class="small text-muted">
        Path: ${removeLastSegment(item.path)}
      </li>
      <li class="small text-muted mb-0">
        Size:   ${item.size ?? 0}KB
      </li>
      <li class="small text-muted mb-0">
        Modified: ${moment(item.last_modified).fromNow()}
       
      </li>
      <li class="small text-muted mb-0">
        Mime Type: ${item.mime_type}
       
      </li>
      <li class="small text-muted mb-0">
        Author: Jaka Swara
      </li>
  </ul>`;
</script>

<template>
  <AppLayout>
    <div
      class="panel panel-inverse flex-1 m-0 d-flex flex-column overflow-hidden"
    >
      <div class="panel-heading"></div>
      <div class="panel-body p-0 flex-1 overflow-hidden">
        <div class="file-manager h-100" ref="fileManager">
          <div class="file-manager-container">
            <div class="file-manager-sidebar">
              <div class="file-manager-sidebar-mobile-toggler">
                <button type="button" class="btn" @click="toggleSidebarClass">
                  <i class="far fa-lg fa-folder"></i>
                </button>
              </div>
              <div class="file-manager-sidebar-content">
                <perfect-scrollbar class="p-3 h-100">
                  <input
                    type="text"
                    class="form-control form-control-sm mb-3"
                    placeholder="Seach file..."
                  />

                  <div class="file-tree mb-3">
                    <div class="file-node has-sub expand selected">
                      <a
                        href="javascript:;"
                        class="file-link"
                        @click.prevent="
                          () => {
                            selectedNode = raw;
                            newFolder = null;
                          }
                        "
                      >
                        <span class="file-arrow"></span>
                        <span class="file-info">
                          <span class="file-icon"
                            ><i class="fa fa-folder fa-lg text-warning"></i
                          ></span>
                          <span class="file-text">{{ raw.name }} </span>
                        </span>
                      </a>
                      <TreeView
                        v-for="dir in raw.directories"
                        :key="dir.path"
                        :node="dir"
                        @selected="onSelectedNode"
                      />

                      <div
                        class="file-node"
                        v-for="file in raw.files"
                        :key="file.path"
                      >
                        <a
                          :href="file.url"
                          class="file-link"
                          v-for="file in raw.files"
                          :key="file.path"
                          ><span class="file-arrow"></span
                          ><span class="file-info"
                            ><span class="file-icon"
                              ><i
                                class="fa fa-file-text fa-lg text-body text-opacity-50"
                              ></i></span
                            ><span class="file-text">{{
                              file.name
                            }}</span></span
                          ></a
                        >
                      </div>
                    </div>
                  </div>
                </perfect-scrollbar>
              </div>
              <div class="file-manager-sidebar-footer">
                <div class="d-flex align-items-center">
                  <div class="mx-n1">
                    <Icon
                      class="iconify fa-3x"
                      icon="solar:ssd-square-bold-duotone"
                    />
                  </div>
                  <div class="flex-1 ps-3 small">
                    <div class="fw-bold">SSD Storage:</div>
                    <div class="progress h-5px my-1">
                      <div
                        class="progress-bar progress-bar-striped bg-inverse"
                        style="width: 80%"
                      ></div>
                    </div>
                    <div class="fw-bold text-body text-opacity-75">
                      <b class="text-body">127.7GB</b> free of
                      <b class="text-body">256GB</b>
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="file-manager-content d-flex flex-column">
              <div class="mb-0 d-flex text-nowrap p-3 border-bottom">
                <button type="button" class="btn btn-sm btn-white me-2 px-2">
                  <i class="fa fa-fw fa-home"></i>
                </button>
                <button
                  type="button"
                  class="btn btn-sm btn-white me-2"
                  :disabled="newFolder !== null"
                  @click="addNewFolder"
                >
                  <i class="fa fa-fw fa-plus ms-n1"></i> Folder
                </button>

                <div class="btn-group me-2">
                  <Upload
                    :path="selectedNode?.path ? selectedNode.path : raw.name"
                  />
                </div>
                <button
                  type="button"
                  class="btn btn-sm btn-white me-2 px-2"
                  @click="isGrid = !isGrid"
                  disabled
                >
                  <i :class="isGrid ? 'bi bi-grid' : 'fa fa-fw fa fa-list'"></i>
                </button>

                <div class="btn-group me-2">
                  <button
                    type="button"
                    class="btn btn-sm btn-white"
                    @click="toggleAll"
                  >
                    <i class="fa fa-fw fa-check ms-n1"></i> Select All
                  </button>

                  <button
                    type="button"
                    class="btn btn-sm btn-white"
                    @click="unToggleAll"
                  >
                    <i class="far fa-fw fa-square ms-n1"></i>
                    Unselect All
                  </button>
                </div>
              </div>
              <div class="flex-1 overflow-hidden">
                <perfect-scrollbar class="h-100 p-0">
                  <table
                    class="table table-striped table-borderless table-sm m-0 text-nowrap"
                    :class="!isGrid ? 'd-block' : 'd-none'"
                  >
                    <thead>
                      <tr class="border-bottom">
                        <!-- Check all -->
                        <th class="w-150px ps-10px text-center">
                          <div class="dropdown">
                            <span
                              id="bulkActionDropdown"
                              data-bs-toggle="dropdown"
                              aria-expanded="false"
                            >
                              Action <i class="caret"></i>
                            </span>
                            <ul
                              class="dropdown-menu"
                              aria-labelledby="bulkActionDropdown"
                            >
                              <li>
                                <a
                                  class="dropdown-item"
                                  href="#"
                                  @click.prevent="bulkDownload"
                                >
                                  <i class="fa fa-trash"></i> Download
                                </a>
                              </li>
                              <li>
                                <a
                                  class="dropdown-item"
                                  href="#"
                                  @click.prevent="bulkDelete"
                                >
                                  <i class="fa fa-trash"></i> Delete
                                </a>
                              </li>
                            </ul>
                          </div>
                        </th>
                        <th class="px-10px">Name</th>
                        <th class="px-10px w-200px">Path</th>
                        <th class="px-10px w-100px">Size</th>
                        <th class="px-10px w-200px">Last Modified</th>
                        <th class="px-10px w-200px">Type</th>
                        <th class="px-10px w-100px">Permission</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr
                        v-for="item in mixedItems"
                        :key="item.path"
                        v-if="selectedNode"
                        :class="item.type == 'folder' && 'cursor-pointer'"
                        @click="item.type == 'folder' && onSelectedNode(item)"
                      >
                        <!-- Row checkbox -->
                        <td class="ps-10px border-0 text-center">
                          <input
                            type="checkbox"
                            v-model="checkedItems"
                            :value="item.path"
                            class="form-check-input"
                            @click.stop
                          />
                        </td>

                        <td class="px-10px border-0">
                          <a
                            v-if="item.type === 'file'"
                            :href="item.url"
                            style="text-decoration: none"
                            target="_blank"
                          >
                            <span class="text-muted">{{ item.name }}</span>
                          </a>
                          <span v-else>
                            <i class="fa fa-folder fa-lg text-warning me-1"></i>
                            {{ item.name }}
                          </span>
                        </td>
                        <td class="px-10px border-0">
                          {{ removeLastSegment(item.path) }}
                        </td>
                        <td class="px-10px">{{ item.size ?? 0 }} KB</td>
                        <td class="px-10px">
                          {{ moment(item.last_modified).fromNow() }}
                        </td>
                        <td class="px-10px">
                          {{
                            item.type === "file"
                              ? item.mime_type
                              : "http:/unix-directory"
                          }}
                        </td>
                        <td class="px-10px border-0">0755</td>
                      </tr>
                    </tbody>
                  </table>

                  <panel :class="isGrid ? 'd-block' : 'd-none'">
                    <panel-body>
                      {{ selectedNode }}
                      <div class="dropdown">
                        <span
                          id="bulkActionDropdown"
                          data-bs-toggle="dropdown"
                          aria-expanded="false"
                        >
                          Action <i class="caret"></i>
                        </span>
                        <ul
                          class="dropdown-menu"
                          aria-labelledby="bulkActionDropdown"
                        >
                          <li>
                            <a
                              class="dropdown-item"
                              href="#"
                              @click.prevent="bulkDownload"
                            >
                              <i class="fa fa-trash"></i> Download
                            </a>
                          </li>
                          <li>
                            <a
                              class="dropdown-item"
                              href="#"
                              @click.prevent="bulkDelete"
                            >
                              <i class="fa fa-trash"></i> Delete
                            </a>
                          </li>
                        </ul>
                      </div>
                      <div class="row row-cols-2 row-cols-md-4 g-3 m-5">
                        <div
                          v-for="item in mixedItems"
                          :key="item.path"
                          v-if="selectedNode"
                          class="col"
                        >
                          <div class="card h-100 text-center">
                            <!-- Checkbox -->
                            <div
                              class="form-check position-absolute top-0 start-0 m-2"
                              v-if="!item.is_new"
                            >
                              <input
                                type="checkbox"
                                v-model="checkedItems"
                                :value="item.path"
                                class="form-check-input"
                                @click.stop
                              />
                            </div>

                            <!-- Icon -->
                            <div
                              class="card-body"
                              v-if="item.type === 'folder'"
                            >
                              <template v-if="item.is_new">
                                <i
                                  class="fa fa-folder fa-3x text-warning mb-2"
                                ></i>

                                <!-- Name -->
                                <h6 class="card-title">
                                  <div class="d-flex">
                                    <input
                                      type="text"
                                      v-model="item.name"
                                      class="form-control mx-2"
                                      ref="folderInput"
                                    />

                                    <button
                                      class="btn btn-sm btn-default"
                                      type="button"
                                      :disabled="item.name == '' || !item.name"
                                      @click="
                                        () =>
                                          newFolderSubmit(item.name, item.path)
                                      "
                                    >
                                      Save
                                    </button>
                                  </div>
                                </h6>
                                <span v-if="errorRef" class="mt-1">{{
                                  errorRef
                                }}</span>
                              </template>
                              <template v-else>
                                <i
                                  class="fa fa-folder fa-3x text-warning mb-2 cursor-pointer"
                                  @click="onSelectedNode(item)"
                                />

                                <h6 class="card-title">{{ item.name }}</h6>
                              </template>
                            </div>
                            <div class="card-body" v-if="item.type == 'file'">
                              <i
                                class="far fa-file-alt fa-3x text-secondary mb-2"
                                data-bs-toggle="popover"
                                data-bs-trigger="hover"
                                :data-bs-title="item.name"
                                data-bs-placement="top"
                                :data-bs-content="popoverContent(item)"
                                data-original-title=""
                                title=""
                              ></i>
                              <a
                                :href="item.url"
                                target="_blank"
                                class="text-decoration-none text-muted"
                              >
                                {{ item.name }}
                              </a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </panel-body>
                  </panel>
                </perfect-scrollbar>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
