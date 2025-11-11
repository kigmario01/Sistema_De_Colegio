# Backend - Sistema de Gestión Escolar

Este proyecto implementa la API y panel administrativo del sistema escolar utilizando **Laravel 11** y **Filament 3**. Incluye autenticación con roles, gestión académica completa y herramientas de reporting.

## Requisitos
- PHP ^8.2
- Composer ^2.6
- MySQL 8 o PostgreSQL 14
- Node.js ^20 (para compilar assets de Filament)

## Instalación
1. Instalar dependencias de PHP:
   ```bash
   composer install
   ```
2. Copiar el archivo de variables de entorno y ajustar la configuración:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
3. Configurar la base de datos en `.env` y ejecutar migraciones y seeders:
   ```bash
   php artisan migrate --seed
   ```
4. Compilar los assets del panel:
   ```bash
   npm install
   npm run build
   ```
5. Iniciar el servidor de desarrollo:
   ```bash
   php artisan serve
   ```

## Estructura Destacada
- `app/Models`: Modelos Eloquent para estudiantes, docentes, materias, calificaciones y asistencia.
- `app/Filament`: Recursos y páginas personalizadas del panel administrativo.
- `app/Http/Controllers`: Controladores API REST y controladores web.
- `database/migrations`: Migraciones con claves foráneas e índices.
- `database/seeders`: Seeders con roles, usuarios de ejemplo y datos académicos base.

## Scripts útiles
- `php artisan make:report` para generar nuevos reportes PDF.
- `php artisan sync:academic-calendar` para recalcular horarios y notificaciones.

## Licencia
Uso interno académico.
