import { defineStore } from 'pinia';
import axios from 'axios';

export const useTeacherStore = defineStore('teachers', {
  state: () => ({
    teachers: [],
    loading: false
  }),
  actions: {
    async fetchTeachers() {
      if (this.teachers.length) return;
      this.loading = true;
      try {
        const { data } = await axios.get('/api/teachers');
        this.teachers = data.data;
      } finally {
        this.loading = false;
      }
    }
  }
});
