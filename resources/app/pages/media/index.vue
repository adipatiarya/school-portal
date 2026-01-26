<script setup lang="ts">
import { ref, onMounted, computed, watch, h, nextTick } from "vue";
import { useAppOptionStore } from "@/stores/app-option";
import { Icon } from "@iconify/vue";
import AppLayout from "@/components/app/AppLayout.vue";
import TreeView from "@/components/app/TreeView.vue";
import moment from "moment";
import FileManagerService from "@/services/filemanager-service";
import { usePopoverInit } from "@/composables/UseProverInit";

const appOption = useAppOptionStore();
interface Node {
  name: string;
  path: string;
  // untuk file
  size?: number;
  last_modified?: string;
  mime_type?: string;
  url?: string;

  // untuk folder
  files?: Node[];
  directories?: Node[];
}
const newFolder = ref<Node | null>(null);
const folderInput = ref(null);

// raw data
const raw = ref<Node>({ name: "uploads", path: "/", directories: [] });
const isLoading = ref(false);
const isGrid = ref(false);

const selectedNode = ref<Node | null>(null);
function onSelectedNode(node: Node) {
  selectedNode.value = node;
  newFolder.value = null;
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
  nextTick(() => {
    folderInput.value?.focus();
  });
}

async function newFolderSubmit() {
  try {
    await FileManagerService.createDir(
      newFolder.value.path,
      newFolder.value.name
    );

    selectedNode.value.directories = [
      ...selectedNode.value.directories,
      newFolder.value,
    ];
    newFolder.value = null;
    //await getData();
  } catch (error) {
    alert(JSON.stringify(error));
  }
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

const fileManager = ref<HTMLElement | null>(null);

function toggleSidebarClass() {
  if (fileManager.value) {
    fileManager.value.classList.toggle("file-manager-sidebar-mobile-toggled");
  }
}

const checkedAll = ref(false);
const checkedItems = ref<string[]>([]);

function toggleAll() {
  checkedItems.value = mixedItems.value.map((item) => item.path);
}
function unToggleAll() {
  checkedItems.value = [];
}

function bulkDelete() {
  console.log("Deleting:", checkedItems.value);
  // TODO: API call or emit event
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
                  @click="addNewFolder"
                >
                  <i class="fa fa-fw fa-plus ms-n1"></i> Folder
                </button>

                <div class="btn-group me-2">
                  <button type="button" class="btn btn-sm btn-white">
                    <i class="fa me-1 fa-upload"></i> Upload
                  </button>
                </div>
                <button
                  type="button"
                  class="btn btn-sm btn-white me-2 px-2"
                  @click="isGrid = !isGrid"
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
                          <div
                            class="card h-100 text-center cursor-pointer"
                            @click="
                              item.type == 'folder' && onSelectedNode(item)
                            "
                          >
                            <!-- Checkbox -->
                            <div
                              class="form-check position-absolute top-0 start-0 m-2"
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
                            <div class="card-body">
                              <i
                                v-if="item.type === 'folder'"
                                class="fa fa-folder fa-3x text-warning mb-2"
                              ></i>
                              <i
                                v-else
                                class="far fa-file-alt fa-3x text-secondary mb-2"
                                data-bs-toggle="popover"
                                data-bs-trigger="hover"
                                :data-bs-title="item.name"
                                data-bs-placement="top"
                                :data-bs-content="popoverContent(item)"
                                data-original-title=""
                                title=""
                              ></i>

                              <!-- Name -->
                              <h6 class="card-title">
                                <a
                                  v-if="item.type === 'file'"
                                  :href="item.url"
                                  target="_blank"
                                  class="text-decoration-none text-muted"
                                >
                                  {{ item.name }}
                                </a>
                                <span v-else>{{ item.name }}</span>
                              </h6>
                            </div>
                          </div>
                        </div>
                        <div v-if="newFolder" class="col">
                          <div class="card h-100 text-center cursor-pointer">
                            <!-- Checkbox -->
                            <div
                              class="form-check position-absolute top-0 start-0 m-2"
                            ></div>

                            <!-- Icon -->
                            <div class="card-body">
                              <i
                                class="fa fa-folder fa-3x text-warning mb-2"
                              ></i>

                              <!-- Name -->
                              <h6 class="card-title">
                                <form
                                  class="d-flex"
                                  @submit.prevent="newFolderSubmit"
                                >
                                  <input
                                    type="text"
                                    v-model="newFolder.name"
                                    class="form-control mx-2"
                                    ref="folderInput"
                                    required
                                  />
                                  <button
                                    class="btn btn-sm btn-default"
                                    type="submit"
                                  >
                                    Save
                                  </button>
                                </form>
                              </h6>
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
