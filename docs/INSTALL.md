# Manual de instalación

## Backend (Laravel + Filament)
1. Instalar dependencias PHP:
   ```bash
   cd backend
   composer install
   ```
2. Configurar variables de entorno:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
3. Ajustar credenciales de base de datos en `.env` y ejecutar migraciones:
   ```bash
   php artisan migrate --seed
   ```
4. Construir assets administrativos:
   ```bash
   npm install
   npm run build
   ```
5. Levantar servidor:
   ```bash
   php artisan serve
   ```

## Frontend (Vue 3)
1. Instalar dependencias:
   ```bash
   cd frontend
   npm install
   ```
2. Configurar variable de entorno opcional `VITE_API_URL` apuntando al backend (por defecto `http://localhost:8000`).
3. Ejecutar servidor de desarrollo:
   ```bash
   npm run dev
   ```
   El frontend consumirá la API disponible en `http://localhost:8000`.

## Autenticación inicial
- Usuario administrador seed de ejemplo: `admin@example.com` / `password` (definir manualmente tras crear usuario en interfaz o seed adicional).
- Un docente y estudiante de ejemplo quedan registrados en los seeders.
