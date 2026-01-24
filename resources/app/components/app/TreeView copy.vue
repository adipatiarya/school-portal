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
  <div class="tree-node">
    <div @click="isOpen = !isOpen" class="node-label">📁 {{ node.name }}</div>

    <div v-if="isOpen" class="children">
      <!-- Render files -->
      <div v-for="file in node.files" :key="file.path" class="file-node">
        📄 {{ file.name }}
      </div>

      <!-- Render sub-directories -->
      <TreeView v-for="dir in node.directories" :key="dir.path" :node="dir" />
    </div>
  </div>
</template>

<style scoped>
.tree-node {
  margin-left: 1rem;
}
.node-label {
  cursor: pointer;
}
.children {
  margin-left: 1rem;
}
.file-node {
  margin-left: 1rem;
}
</style>
