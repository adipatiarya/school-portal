<script setup lang="ts">
import { useAuthStore } from "./stores/auth";

const authStore = useAuthStore();
</script>

<template>
  <div v-if="!authStore.isLoading">
    <router-view></router-view>
  </div>
  <div v-else class="app-loader">
    <span class="spinner"></span>
  </div>
</template>
