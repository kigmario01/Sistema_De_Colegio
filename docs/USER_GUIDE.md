# Guía de usuario final

## Acceso al sistema
1. Ingrese a `http://localhost:8000/admin`.
2. Autentíquese con un usuario con rol **admin** o **docente**.

## Panel administrativo (Filament)
- **Estudiantes**: Alta y edición completa, consulta de estado académico y tutor.
- **Docentes**: Gestión de materias asignadas y horarios.
- **Aulas**: Configuración de capacidad, sección y periodo académico.
- **Asistencias**: Registro diario con indicadores visuales.
- **Calificaciones**: Carga de notas parciales, cálculo automático de promedios y semáforo de aprobación.
- **Reportes**: Exportación en PDF/Excel desde los botones superiores de cada listado.

## Portal docente
- Al ingresar verá un tablero con accesos rápidos a registros de asistencia y calificaciones.
- Puede filtrar estudiantes por grado y sección.

## Portal público (frontend)
- `http://localhost:5173/`: Vista resumida con gráficos de asistencia.
- Secciones "Estudiantes" y "Docentes" permiten consultar información sin autenticación.

## Notificaciones
- Los estudiantes reciben correo y notificación interna cuando cambia el estado de una calificación.
- Los administradores visualizan alertas de ausentismo en el dashboard de Filament.

## Criterios de aprobación
- Configurables en `config/school.php` y `school_settings`.
- Por defecto, nota aprobatoria >= 10.

## Recuperación de contraseñas
- Disponible desde la pantalla de login de Filament.

## Soporte
- Para mantenimiento ejecutar `php artisan sync:academic-calendar` y revisar logs en `storage/logs/laravel.log`.
