<script setup lang="ts">
import AppLayout from "@/components/app/AppLayout.vue";
import { useI18n } from "vue-i18n";
import { onMounted, ref } from "vue";
import Panel from "@/components/bootstrap/Panel.vue";
import BarChart from "@/composables/BarChart";

import { DashboardService } from "@/services/dashboard-service";

//import AppThemePanel from "@/components/app/ThemePanel.vue";
const { t } = useI18n();

const years = ["TAHUN", "2026", "2025", "2024", "2023", "2022", "2021"];

const selectedYear = ref("TAHUN");

const selectYear = async (year) => {
  selectedYear.value = year;

  await fetchData();
};

const isLoading = ref(false);

const chartData1 = ref({
  labels: [],
  datasets: [
    {
      data: [],
      backgroundColor: "rgb(52, 143, 226)",
    },
  ],
});

const chartOptions = {
  responsive: true,
  maintainAspectRatio: true,
  plugins: {
    legend: {
      display: false,
    },
    datalabels: {
      anchor: "end",
      align: "top",
      color: "#fff",

      font: {
        weight: "bold",
        size: 10,
      },
      formatter: (value) => `${value}%`, // optional kalau mau tambah %
    },
  },
  interaction: {
    mode: "index",
    intersect: false,
  },
  scales: {
    y: {
      border: {
        color:
          "rgba(" +
          getComputedStyle(document.body)
            .getPropertyValue("--bs-white-rgb")
            .trim() +
          ", .15)",
        width: 0.5,
      },
      grid: {
        color:
          "rgba(" +
          getComputedStyle(document.body)
            .getPropertyValue("--bs-white-rgb")
            .trim() +
          ", .15)", // Color of the interior grid lines
        width: 0.5,
      },
      beginAtZero: true,
      min: 0,
      max: 125,
      title: {
        display: true,
        text: "KEHADIRAN SISWA",

        font: {
          size: 12,
          weight: "bold",
        },
        color: "#fff",
      },
      ticks: {
        stepSize: 25,
        callback: function (value) {
          return value + "%";
        },
        color: "#fff",
      },
    },
    x: {
      border: {
        color:
          "rgba(" +
          getComputedStyle(document.body)
            .getPropertyValue("--bs-white-rgb")
            .trim() +
          ", .15)", // Color of the vertical/horizontal axis line
        width: 0.5,
      },
      grid: {
        color:
          "rgba(" +
          getComputedStyle(document.body)
            .getPropertyValue("--bs-white-rgb")
            .trim() +
          ", .15)", // Color of the interior grid lines
        width: 0.5,
      },
      ticks: {
        color: "#fff",
      },
    },
  },
};

onMounted(async () => {
  await fetchData();
});
async function fetchData() {
  isLoading.value = true;
  const { data } = await DashboardService.detail({
    year: selectedYear.value == "TAHUN" ? "ALL" : selectedYear.value,
  });
  chartData1.value.labels = data.studentAbsentChart.label;
  chartData1.value.datasets[0].data = data.studentAbsentChart.data;
  isLoading.value = false;
}
</script>

<template>
  <AppLayout v-if="!isLoading">
    <!-- BEGIN breadcrumb -->

    <!-- END breadcrumb -->
    <!-- BEGIN page-header -->
    <h1 class="page-header">DASHBOARD</h1>
    <panel>
      <panel-body>
        <h5 class="page-title">
          <i class="fas fa-bullhorn mx-2"></i>Pengumuman Terbaru
        </h5>
        <ul>
          <li>Ujian Tengah Semester dimulai 5 Feb</li>
          <li>Workshop Guru 12 Maret</li>
        </ul>
      </panel-body>
    </panel>

    <div class="d-sm-flex align-items-center mb-3">
      <button
        class="btn btn-dark me-2 text-truncate dropdown-toggle"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false"
      >
        <i class="fa fa-calendar fa-fw text-white text-opacity-50 ms-n1"></i>
        <span class="mx-2">{{ selectedYear }}</span>
        <b class="caret ms-1 opacity-5"></b>
      </button>
      <ul class="dropdown-menu">
        <li v-for="year in years" :key="year">
          <a
            class="dropdown-item"
            href="#"
            @click.prevent="selectYear(year)"
            :class="{ active: selectedYear === year }"
          >
            {{ year }}
          </a>
        </li>
      </ul>
    </div>
    <div class="row">
      <!-- BEGIN col-3 -->
      <div class="col-xl-3 col-md-6">
        <div class="widget widget-stats bg-blue">
          <div class="stats-icon"><i class="fa fa-users"></i></div>
          <div class="stats-info">
            <h4>TOTAL SISWA</h4>
            <p>100</p>
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
            <h4>TOTAL GURU</h4>
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
          <div class="stats-icon"><i class="fa fa fa-university"></i></div>
          <div class="stats-info">
            <h4>MATA PELAJARAN AKTIF</h4>
            <p>20</p>
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
          <div class="stats-icon"><i class="fa fa-credit-card"></i></div>
          <div class="stats-info">
            <h4>TAGIHAN LUNAS</h4>
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

    <div class="row">
      <div class="col-xl-8 col-lg-6">
        <panel>
          <panel-body>
            <div class="mb-3 text-white text-center">
              <b
                >GRAFIK KEHADIRAN SISWA
                {{ selectedYear == "TAHUN" ? "TAHUNAN" : "BULANAN" }}</b
              >
            </div>
            <BarChart :data="chartData1" :options="chartOptions" />
          </panel-body>
        </panel>
      </div>
    </div>
  </AppLayout>
  <div v-else class="app-loader">
    <span class="spinner"></span>
  </div>
</template>
