<script setup>
import { Chart as ChartJS, Title, Tooltip, Legend, ArcElement } from "chart.js";
import { Doughnut } from "vue-chartjs";

ChartJS.register(Title, Tooltip, Legend, ArcElement);

const data = {
  labels: ["Lunas", "Belum Lunas"],
  datasets: [
    {
      data: [420, 100],
      backgroundColor: ["#10b981", "#ef4444"],
    },
  ],
};

const options = { responsive: true };
</script>

<template>
  <Doughnut :data="data" :options="options" />
</template>
