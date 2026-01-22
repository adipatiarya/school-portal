<script setup lang="ts">
import AppLayout from "@/components/app/AppLayout.vue";
import { useI18n } from "vue-i18n";
//import AppThemePanel from "@/components/app/ThemePanel.vue";
const { t } = useI18n();
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
    <div class="row">
      <!-- BEGIN col-3 -->
      <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-blue">
          <div class="stats-icon"><i class="fa fa-users"></i></div>
          <div class="stats-info">
            <h4>SISWA</h4>
            <p>3,291,922</p>
          </div>
          <div class="stats-link">
            <a href="javascript:;"
              >View Detail <i class="fa fa-arrow-alt-circle-right"></i
            ></a>
          </div>
        </div>
      </div>
      <!-- END col-3 -->
      <!-- BEGIN col-3 -->
      <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-info">
          <div class="stats-icon">
            <i class="fa-solid fa-graduation-cap"></i>
          </div>
          <div class="stats-info">
            <h4>GURU</h4>
            <p>150</p>
          </div>
          <div class="stats-link">
            <a href="javascript:;"
              >View Detail <i class="fa fa-arrow-alt-circle-right"></i
            ></a>
          </div>
        </div>
      </div>
      <!-- END col-3 -->
      <!-- BEGIN col-3 -->
      <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-orange">
          <div class="stats-icon"><i class="fa fa-credit-card"></i></div>
          <div class="stats-info">
            <h4>PENDAPATAN</h4>
            <p>1,291,922</p>
          </div>
          <div class="stats-link">
            <a href="javascript:;"
              >View Detail <i class="fa fa-arrow-alt-circle-right"></i
            ></a>
          </div>
        </div>
      </div>
      <!-- END col-3 -->
      <!-- BEGIN col-3 -->
      <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-red">
          <div class="stats-icon"><i class="fa fa-clock"></i></div>
          <div class="stats-info">
            <h4>AKTIFITAS HARIAN</h4>
            <p>20%</p>
          </div>
          <div class="stats-link">
            <a href="javascript:;"
              >View Detail <i class="fa fa-arrow-alt-circle-right"></i
            ></a>
          </div>
        </div>
      </div>
      <!-- END col-3 -->
    </div>
  </AppLayout>
</template>
