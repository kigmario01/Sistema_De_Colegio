<template>
  <section>
    <h2>Estudiantes</h2>
    <div class="filters">
      <label>
        Buscar
        <input v-model="filters.search" type="text" placeholder="Nombre o documento" />
      </label>
      <label>
        Grado
        <select v-model="filters.grade">
          <option value="">Todos</option>
          <option v-for="grade in grades" :key="grade" :value="grade">{{ grade }}</option>
        </select>
      </label>
    </div>
    <table>
      <thead>
        <tr>
          <th>Estudiante</th>
          <th>Documento</th>
          <th>Grado</th>
          <th>Sección</th>
          <th>Estado</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="student in filteredStudents" :key="student.id">
          <td>{{ student.full_name }}</td>
          <td>{{ student.document_number }}</td>
          <td>{{ student.academic.grade }}</td>
          <td>{{ student.academic.section }}</td>
          <td>
            <span :class="['badge', student.academic.status === 'activo' ? 'badge--success' : 'badge--danger']">
              {{ student.academic.status }}
            </span>
          </td>
        </tr>
      </tbody>
    </table>
  </section>
</template>

<script setup>
import { computed, onMounted, reactive, ref } from 'vue';
import { useStudentStore } from '../store/students';

const store = useStudentStore();
const filters = reactive({ search: '', grade: '' });
const grades = ref([]);

onMounted(async () => {
  await store.fetchStudents();
  grades.value = Array.from(new Set(store.students.map(student => student.academic.grade)));
});

const filteredStudents = computed(() => {
  return store.students.filter(student => {
    const matchesSearch = student.full_name.toLowerCase().includes(filters.search.toLowerCase()) ||
      student.document_number.includes(filters.search);
    const matchesGrade = !filters.grade || student.academic.grade === filters.grade;
    return matchesSearch && matchesGrade;
  });
});
</script>

<style scoped>
.filters {
  display: flex;
  gap: 1rem;
  margin-bottom: 1rem;
}
.badge {
  padding: 0.25rem 0.5rem;
  border-radius: 4px;
  color: white;
  text-transform: capitalize;
}
.badge--success { background: #16a34a; }
.badge--danger { background: #dc2626; }
</style>
