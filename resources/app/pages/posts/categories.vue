<script setup lang="ts">
import AppLayout from "@/components/app/AppLayout.vue";
import { useI18n } from "vue-i18n";
const { t } = useI18n();
</script>

<template>
  <AppLayout>
    <!-- BEGIN breadcrumb -->
    <ol class="breadcrumb float-xl-end">
      <li class="breadcrumb-item"><a href="javascript:;">Dashboard</a></li>
      <li class="breadcrumb-item active">
        <a href="javascript:;">{{ t("Kategori") }} </a>
      </li>
    </ol>
    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h1 class="page-header">
      {{ t("Kategori") }}
    </h1>
  </AppLayout>
</template>
