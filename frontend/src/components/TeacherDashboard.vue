<template>
  <section>
    <h2>Docentes</h2>
    <ul class="teacher-list">
      <li v-for="teacher in teachers" :key="teacher.id">
        <header>
          <h3>{{ teacher.first_name }} {{ teacher.last_name }}</h3>
          <span>{{ teacher.specialty }}</span>
        </header>
        <p><strong>Materias:</strong> {{ teacher.subjects.map(subject => subject.name).join(', ') }}</p>
        <p><strong>Horarios:</strong></p>
        <ul>
          <li v-for="schedule in teacher.schedules" :key="schedule.id">
            {{ schedule.day_of_week }} - {{ schedule.starts_at }} a {{ schedule.ends_at }} ({{ schedule.classroom?.name }})
          </li>
        </ul>
      </li>
    </ul>
  </section>
</template>

<script setup>
import { onMounted } from 'vue';
import { useTeacherStore } from '../store/teachers';

const store = useTeacherStore();
const { teachers } = store;

onMounted(async () => {
  await store.fetchTeachers();
});
</script>

<style scoped>
.teacher-list {
  display: grid;
  gap: 1rem;
}
.teacher-list li {
  border: 1px solid #e5e7eb;
  border-radius: 8px;
  padding: 1rem;
  background: white;
  box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
}
.teacher-list header {
  display: flex;
  justify-content: space-between;
  align-items: baseline;
}
</style>
