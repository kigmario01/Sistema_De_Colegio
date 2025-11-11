import { defineStore } from 'pinia';
import axios from 'axios';

export const useStudentStore = defineStore('students', {
  state: () => ({
    students: [],
    loading: false
  }),
  actions: {
    async fetchStudents() {
      if (this.students.length) return;
      this.loading = true;
      try {
        const { data } = await axios.get('/api/students');
        this.students = data.data;
      } finally {
        this.loading = false;
      }
    }
  }
});
