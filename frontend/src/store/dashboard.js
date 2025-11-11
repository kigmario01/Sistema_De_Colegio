import { defineStore } from 'pinia';
import axios from 'axios';

export const useDashboardStore = defineStore('dashboard', {
  state: () => ({
    attendanceSummary: null
  }),
  actions: {
    async fetchAttendanceSummary() {
      if (this.attendanceSummary) return this.attendanceSummary;
      const { data } = await axios.get('/api/attendances', { params: { per_page: 0 } });
      const grouped = {};
      data.data.forEach(record => {
        const day = record.date;
        if (!grouped[day]) grouped[day] = { presentes: 0, ausencias: 0 };
        if (record.status === 'presente') {
          grouped[day].presentes += 1;
        } else {
          grouped[day].ausencias += 1;
        }
      });
      const labels = Object.keys(grouped);
      const presentes = labels.map(label => grouped[label].presentes);
      const ausencias = labels.map(label => grouped[label].ausencias);
      this.attendanceSummary = {
        labels,
        datasets: [
          { label: 'Presentes', backgroundColor: '#16a34a', data: presentes },
          { label: 'Ausencias', backgroundColor: '#dc2626', data: ausencias }
        ]
      };
      return this.attendanceSummary;
    }
  }
});
