import { createRouter, createWebHistory } from 'vue-router';
import HomePage from '../components/HomePage.vue';
import StudentDashboard from '../components/StudentDashboard.vue';
import TeacherDashboard from '../components/TeacherDashboard.vue';

const routes = [
  { path: '/', component: HomePage },
  { path: '/estudiantes', component: StudentDashboard },
  { path: '/docentes', component: TeacherDashboard }
];

const router = createRouter({
  history: createWebHistory(),
  routes
});

export default router;
