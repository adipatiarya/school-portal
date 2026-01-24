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
  <div class="file-table">
    <h4 @click="isOpen = !isOpen" class="folder-title">📁 {{ node.name }}</h4>

    <table v-if="isOpen" class="table table-sm">
      <thead>
        <tr>
          <th>Nama</th>
          <th>Path</th>
          <th>Tipe</th>
        </tr>
      </thead>
      <tbody>
        <!-- Files -->

        <!-- Directories -->
        <tr v-for="dir in node.directories" :key="dir.path">
          <td>{{ dir.name }}</td>
          <td>{{ dir.path }}</td>
          <td>Folder</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<style scoped>
.file-table {
  margin: 1rem 0;
}
.folder-title {
  cursor: pointer;
  margin-bottom: 0.5rem;
}
.table {
  width: 100%;
  border-collapse: collapse;
}
.table th,
.table td {
  border: 1px solid #ddd;
  padding: 6px;
}
.sub-folder {
  margin-left: 1rem;
}
</style>
