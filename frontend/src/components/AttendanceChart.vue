<template>
  <section>
    <h3>Asistencia semanal</h3>
    <canvas ref="canvas" width="400" height="200"></canvas>
  </section>
</template>

<script setup>
import { onMounted, ref } from 'vue';
import { useDashboardStore } from '../store/dashboard';
import Chart from 'chart.js/auto';

const canvas = ref(null);
const store = useDashboardStore();

onMounted(async () => {
  const data = await store.fetchAttendanceSummary();
  new Chart(canvas.value, {
    type: 'bar',
    data: {
      labels: data.labels,
      datasets: data.datasets
    }
  });
});
</script>
