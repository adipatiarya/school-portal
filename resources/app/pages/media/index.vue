<script setup lang="ts">
import { ref, onMounted, computed } from "vue";
import { useAppOptionStore } from "@/stores/app-option";
import { Icon } from "@iconify/vue";
import AppLayout from "@/components/app/AppLayout.vue";
import TreeView from "@/components/app/TreeView.vue";
import moment from "moment";
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
// raw data
const raw = ref({
  name: "uploads",
  path: "uploads",
  files: [],
  directories: [
    {
      name: "2026",
      path: "uploads/2026",
      files: [],
      directories: [
        {
          name: "01-24",
          path: "uploads/2026/01-24",
          files: [
            {
              name: "test_mansasa.pdf",
              path: "uploads/2026/01-24/test_1769240312.pdf",
              size: 0,
              last_modified: "2026-01-24 07:38:32",
              mime_type: "application/pdf",
              url: "/storage/uploads/2026/01-24/test_1769240312.pdf",
            },
            {
              name: "test_1769240694.pdf",
              path: "uploads/2026/01-24/test_1769240694.pdf",
              size: 0,
              last_modified: "2026-01-24 07:44:54",
              mime_type: "application/pdf",
              url: "/storage/uploads/2026/01-24/test_1769240694.pdf",
            },
            {
              name: "test_1769240873.pdf",
              path: "uploads/2026/01-24/test_1769240873.pdf",
              size: 0,
              last_modified: "2026-01-24 07:47:53",
              mime_type: "application/pdf",
              url: "/storage/uploads/2026/01-24/test_1769240873.pdf",
            },
          ],
          directories: [],
        },
      ],
    },
    {
      name: "2027",
      path: "uploads/2027",
      files: [
        {
          name: "test_mansasa.pdf",
          path: "uploads/2027/test_1769240312.pdf",
          size: 0,
          last_modified: "2027-01-24 07:38:32",
          mime_type: "application/pdf",
          url: "/storage/uploads/2027/test_1769240312.pdf",
        },
      ],
      directories: [
        {
          name: "01-24",
          path: "uploads/2027/01-24",
          files: [
            {
              name: "test_1769240312.pdf",
              path: "uploads/2027/01-24/test_1769240312.pdf",
              size: 0,
              last_modified: "2027-01-24 07:38:32",
              mime_type: "application/pdf",
              url: "/storage/uploads/2027/01-24/test_1769240312.pdf",
            },
            {
              name: "test_1769240694.pdf",
              path: "uploads/2027/01-24/test_1769240694.pdf",
              size: 0,
              last_modified: "2027-01-24 07:44:54",
              mime_type: "application/pdf",
              url: "/storage/uploads/2027/01-24/test_1769240694.pdf",
            },
            {
              name: "test_1769240873.pdf",
              path: "uploads/2027/01-24/test_1769240873.pdf",
              size: 0,
              last_modified: "2027-01-24 07:47:53",
              mime_type: "application/pdf",
              url: "/storage/uploads/2027/01-24/test_1769240873.pdf",
            },
          ],
          directories: [],
        },
      ],
    },
  ],
});
const selectedNode = ref<Node | null>(null);
function onSelectedNode(node: Node) {
  selectedNode.value = node;
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
});
</script>

<template>
  <AppLayout>
    <div
      class="panel panel-inverse flex-1 m-0 d-flex flex-column overflow-hidden"
    >
      <div class="panel-heading">
        <h4 class="panel-title">File Manager</h4>
      </div>
      <div class="panel-body p-0 flex-1 overflow-hidden">
        <div class="file-manager h-100" id="fileManager">
          <div class="file-manager-toolbar d-none">
            <button type="button" class="btn shadow-none text-body border-0">
              <i class="fa fa-lg me-1 fa-plus"></i> File
            </button>
            <button type="button" class="btn shadow-none text-body border-0">
              <i class="fa fa-lg me-1 fa-plus"></i> Folder
            </button>
            <button
              type="button"
              class="btn shadow-none text-body text-opacity-50 border-0"
              disabled
            >
              <i class="fa fa-lg me-1 fa-copy"></i> Copy
            </button>
            <button
              type="button"
              class="btn shadow-none text-body text-opacity-50 border-0"
              disabled
            >
              <i class="fa fa-lg me-1 fa-move"></i> Move
            </button>
            <button type="button" class="btn shadow-none text-body border-0">
              <i class="fa fa-lg me-1 fa-upload"></i> Upload
            </button>
            <button
              type="button"
              class="btn shadow-none text-body text-opacity-50 border-0"
              disabled
            >
              <i class="fa fa-lg me-1 fa-download"></i> Download
            </button>
            <button
              type="button"
              class="btn shadow-none text-body text-opacity-50 border-0"
              disabled
            >
              <i class="fa fa-lg me-1 fa-xmark"></i> Delete
            </button>
            <button
              type="button"
              class="btn shadow-none text-body text-opacity-50 border-0"
              disabled
            >
              <i class="fa fa-lg me-1 fa-rotate-left"></i> Restore
            </button>
            <button
              type="button"
              class="btn shadow-none text-body text-opacity-50 border-0"
              disabled
            >
              <i class="fa fa-lg me-1 fa-file"></i> Rename
            </button>
            <button
              type="button"
              class="btn shadow-none text-body text-opacity-50 border-0"
              disabled
            >
              <i class="fa fa-lg me-1 fa-pen"></i> Edit
            </button>
            <button
              type="button"
              class="btn shadow-none text-body text-opacity-50 border-0"
              disabled
            >
              <i class="fa fa-lg me-1 fa-pen-to-square"></i> HTML Editor
            </button>
            <button
              type="button"
              class="btn shadow-none text-body text-opacity-50 border-0"
              disabled
            >
              <i class="fa fa-lg me-1 fa-key"></i> Permissions
            </button>
            <button
              type="button"
              class="btn shadow-none text-body text-opacity-50 border-0"
              disabled
            >
              <i class="fa fa-lg me-1 fa-file"></i> View
            </button>
            <button
              type="button"
              class="btn shadow-none text-body text-opacity-50 border-0"
              disabled
            >
              <i class="fa fa-lg me-1 fa-lock-open"></i> Extract
            </button>
            <button
              type="button"
              class="btn shadow-none text-body text-opacity-50 border-0"
              disabled
            >
              <i class="fa fa-lg me-1 fa-file-zipper"></i> Compress
            </button>
          </div>
          <div class="file-manager-container">
            <div class="file-manager-sidebar">
              <div class="file-manager-sidebar-mobile-toggler">
                <button
                  type="button"
                  class="btn"
                  data-toggle-class="file-manager-sidebar-mobile-toggled"
                  data-target="#fileManager"
                >
                  <i class="far fa-lg fa-folder"></i> fgfgf
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
                          }
                        "
                      >
                        <span class="file-arrow"></span>
                        <span class="file-info">
                          <span class="file-icon"
                            ><i class="fa fa-folder fa-lg text-warning"></i
                          ></span>
                          <span class="file-text">uploads</span>
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
                <button type="button" class="btn btn-sm btn-white me-2">
                  <i class="fa fa-fw fa-plus ms-n1"></i> Folder
                </button>

                <div class="btn-group me-2">
                  <button type="button" class="btn btn-sm btn-white">
                    <i class="fa me-1 fa-upload"></i> Upload
                  </button>
                  <button
                    type="button"
                    class="btn btn-sm btn-white text-opacity-50"
                  >
                    <i class="fa me-1 fa-download"></i> Download
                  </button>
                </div>
                <button type="button" class="btn btn-sm btn-white me-2 px-2">
                  <i class="fa fa-fw fa-arrows-rotate"></i>
                </button>

                <div class="btn-group me-2">
                  <button type="button" class="btn btn-sm btn-white">
                    <i class="fa fa-fw fa-check ms-n1"></i> Select All
                  </button>
                  <button type="button" class="btn btn-sm btn-white">
                    <i class="far fa-fw fa-square ms-n1"></i> Unselect All
                  </button>
                </div>
              </div>
              <div class="flex-1 overflow-hidden">
                <perfect-scrollbar class="h-100 p-0">
                  <table
                    class="table table-striped table-borderless table-sm m-0 text-nowrap"
                  >
                    <thead>
                      <tr class="border-bottom">
                        <th class="w-10px ps-10px"></th>
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
                      >
                        <td class="ps-10px border-0 text-center">
                          <i
                            class="fa fa-folder text-warning fa-lg"
                            v-if="item.type == 'folder'"
                          ></i>
                          <i
                            v-else
                            class="far fa-file-text text-body text-opacity-50 fa-lg"
                          ></i>
                        </td>
                        <td class="px-10px border-0">{{ item.name }}</td>
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
                </perfect-scrollbar>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </AppLayout>
</template>
