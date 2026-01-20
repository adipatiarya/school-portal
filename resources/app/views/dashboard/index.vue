<script setup lang="ts">
import AppLayout from "@/components/app/AppLayout.vue";
import AppThemePanel from "@/components/app/ThemePanel.vue";
</script>

<template>
  <AppLayout>
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb float-xl-end">
      <li class="breadcrumb-item"><a href="javascript:;">Home</a></li>
      <li class="breadcrumb-item"><a href="javascript:;">Page Options</a></li>
      <li class="breadcrumb-item active">Blank Page</li>
    </ol>
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h1 class="page-header">DASHBOARD</h1>
    <!-- END page-header -->
    <!-- BEGIN panel -->
    <!-- <panel>
      <panel-header>
        <panel-title>Panel Title here</panel-title>
        <panel-toolbar />
      </panel-header>
      <panel-body> Panel Content Here </panel-body>
    </panel> -->
    <!-- END panel -->
    <template #app-theme-panel>
      <AppThemePanel></AppThemePanel>
    </template>
  </AppLayout>
</template>
