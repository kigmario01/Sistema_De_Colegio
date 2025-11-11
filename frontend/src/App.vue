<template>
  <div>
    <header class="app-header">
      <h1>Sistema Escolar</h1>
      <nav>
        <RouterLink to="/">Inicio</RouterLink>
        <RouterLink to="/estudiantes">Estudiantes</RouterLink>
        <RouterLink to="/docentes">Docentes</RouterLink>
      </nav>
    </header>
    <main>
      <RouterView />
    </main>
  </div>
</template>

<style scoped>
.app-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  padding: 1rem;
  background: #1d4ed8;
  color: white;
}
nav a {
  color: white;
  margin-right: 1rem;
  text-decoration: none;
}
nav a.router-link-active {
  font-weight: bold;
  text-decoration: underline;
}
main {
  padding: 1.5rem;
}
</style>
