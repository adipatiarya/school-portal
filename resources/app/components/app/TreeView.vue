<script setup lang="ts">
import { ref } from "vue";

interface Node {
  name: string;
  path: string;
  files?: Node[];
  directories?: Node[];
}

defineProps<{ node: Node }>();

const isOpen = ref(false);
</script>

<template>
  <div class="file-tree">
    <div
      class="file-node"
      :class="(node.files.length || node.directories.length) && 'has-sub'"
    >
      <a href="javascript:;" class="file-link"
        ><span class="file-arrow"></span
        ><span class="file-info"
          ><span class="file-icon"
            ><i class="fa fa-folder fa-lg text-warning"></i></span
          ><span class="file-text">{{ node.name }}</span></span
        ></a
      >
      <div class="file-tree">
        <div class="file-node" v-for="file in node.files" :key="file.path">
          <a href="javascript:;" class="file-link"
            ><span class="file-arrow"></span
            ><span class="file-info"
              ><span class="file-icon"
                ><i
                  class="fa fa-file-text fa-lg text-body text-opacity-50"
                ></i></span
              ><span class="file-text">{{ file.name }}</span></span
            ></a
          >
        </div>
      </div>

      <TreeView v-for="dir in node.directories" :key="dir.path" :node="dir" />
    </div>
  </div>
</template>
