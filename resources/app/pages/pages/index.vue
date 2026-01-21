<script setup lang="ts">
import AppLayout from "@/components/app/AppLayout.vue";
import { RouterName } from "@/types";
import { useI18n } from "vue-i18n";
import { RouterLink } from "vue-router";

const { t } = useI18n();
</script>

<template>
  <AppLayout>
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb float-xl-end">
      <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
      <li class="breadcrumb-item active">
        <a href="javascript:;">{{ t("Daftar Halaman") }} </a>
      </li>
    </ol>
    <h1 class="page-header">
      {{ t("Daftar Halaman") }}
    </h1>

    <panel>
      <panel-body>
        <RouterLink :to="{ name: RouterName.PAGES_DETAIL, params: { id: 1 } }"
          >AS</RouterLink
        >
      </panel-body>
    </panel>
  </AppLayout>
</template>
