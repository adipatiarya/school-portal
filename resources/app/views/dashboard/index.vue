<script setup lang="ts">
import AppLayout from "@/components/app/AppLayout.vue";
import AppThemePanel from "@/components/app/ThemePanel.vue";
</script>

<template>
  <AppLayout>
    <div>YES</div>
    <template #app-theme-panel>
      <AppThemePanel></AppThemePanel>
    </template>
  </AppLayout>
</template>
