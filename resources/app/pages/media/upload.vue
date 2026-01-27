<template>
  <div>
    <!-- Hidden file input -->
    <input
      type="file"
      id="upload"
      class="d-none"
      @change="handleFileUpload"
      ref="fileInput"
    />

    <button type="button" class="btn btn-sm btn-white" @click="triggerUpload">
      <i class="fa me-1 fa-upload"></i>
      Upload
    </button>
  </div>
</template>

<script setup lang="ts">
import FileManagerService from "@/services/filemanager-service";
import { ref } from "vue";

const props = defineProps<{
  path: string;
}>();

const selectedFile = ref(null);
const fileInput = ref(null);

const triggerUpload = () => {
  fileInput.value.click(); // programmatically open file dialog
};

const handleFileUpload = (event) => {
  const file = event.target.files[0];
  if (file) {
    selectedFile.value = file;
    // You can now send it to backend via FormData
    const formData = new FormData();
    formData.append("file", file);
    formData.append("path", props.path);

    FileManagerService.upload(formData).then(() => {
      //location.reload();
    });
  }
};
</script>
