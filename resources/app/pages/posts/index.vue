<script setup lang="ts">
import AppLayout from "@/components/app/AppLayout.vue";
import { RouterName } from "@/types";
import { useI18n } from "vue-i18n";
import { RouterLink } from "vue-router";
//import AppThemePanel from "@/components/app/ThemePanel.vue";
const { t } = useI18n();
</script>

<template>
  <AppLayout>
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb float-xl-end">
      <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
      <li class="breadcrumb-item active">
        <a href="javascript:;">{{ t("Daftar Artikel") }} </a>
      </li>
    </ol>
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h1 class="page-header">
      {{ t("Daftar Artikel") }}
    </h1>
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
    <!-- <template #app-theme-panel>
      <AppThemePanel></AppThemePanel>
    </template> -->
    <panel>
      <panel-body>
        <RouterLink :to="{ name: RouterName.POSTS_DETAIL, params: { id: 1 } }"
          >AS</RouterLink
        >
      </panel-body>
    </panel>
  </AppLayout>
</template>
