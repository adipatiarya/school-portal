<script setup>
import {
  Chart as ChartJS,
  Title,
  Tooltip,
  Legend,
  LineElement,
  PointElement,
  CategoryScale,
  LinearScale,
} from "chart.js";
import { Line } from "vue-chartjs";

ChartJS.register(
  Title,
  Tooltip,
  Legend,
  LineElement,
  PointElement,
  CategoryScale,
  LinearScale
);

const data = {
  labels: ["TKJ", "AKL", "OTKP", "RPL"],
  datasets: [
    {
      label: "Nilai Rata-rata",
      data: [78, 82, 80, 85],
      borderColor: "#10b981",
      backgroundColor: "#10b981",
      fill: false,
    },
  ],
};

const options = { responsive: true };
</script>

<template>
  <Line :data="data" :options="options" />
</template>
