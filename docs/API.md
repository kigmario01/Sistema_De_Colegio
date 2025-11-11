# Documentación técnica de la API

## Autenticación
- Token bearer mediante Laravel Sanctum.
- Registrar token vía `POST /sanctum/token` (requiere credenciales de usuario).

## Endpoints principales

### Estudiantes
- `GET /api/students` — Listado paginado con filtros `?search=` y `?grade=`.
- `POST /api/students` — Crea estudiante (requiere permisos `create estudiantes`).
- `GET /api/students/{id}` — Detalle con matrículas, calificaciones y asistencia.
- `PUT /api/students/{id}` — Actualiza información.
- `DELETE /api/students/{id}` — Eliminación lógica.

### Docentes
- `GET /api/teachers`
- `POST /api/teachers`
- `GET /api/teachers/{id}`
- `PUT /api/teachers/{id}`
- `DELETE /api/teachers/{id}`

### Aulas
- `GET /api/classrooms`
- `POST /api/classrooms`
- `GET /api/classrooms/{id}`
- `PUT /api/classrooms/{id}`
- `DELETE /api/classrooms/{id}`

### Asistencias
- `GET /api/attendances` — Permite parámetros `?classroom_id`, `?subject_id`, `?from`, `?to`, `?per_page`.
- `POST /api/attendances`
- `PUT /api/attendances/{id}`

### Calificaciones
- `GET /api/grades`
- `POST /api/grades`
- `GET /api/grades/{id}`
- `PUT /api/grades/{id}`

### Reportes
- `GET /api/reports/attendance/pdf?classroom_id=1&from=2025-05-01&to=2025-05-31`
- `GET /api/reports/attendance/excel?classroom_id=1&from=2025-05-01&to=2025-05-31`
- `GET /api/reports/grades/excel?classroom_id=1&subject_id=1&academic_period_id=1`

## Respuestas de error
- 401: Token inválido o ausente.
- 403: Rol sin permisos suficientes.
- 422: Validaciones fallidas.
- 500: Error interno.

## Paginación
- Sigue especificación JSON:API con claves `data`, `links`, `meta`.

## Versionado
- La API está versionada mediante prefijo `v1` configurable en `RouteServiceProvider` (actualmente `/api`).
