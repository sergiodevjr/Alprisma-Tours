# Alprisma Tours

Proyecto final: aplicación web con Laravel, Bootstrap y MySQL (CRUD, login y roles).

## Requisitos
PHP 8.2+, Composer, Node.js y MySQL (XAMPP).

## Instalación
1. Crear la base de datos: `CREATE DATABASE agencia_viaje;`
2. `composer install`
3. `npm install` y `npm run build`
4. Copiar `.env.example` a `.env`, configurar `DB_DATABASE=agencia_viaje` y poner `APP_LOCALE=es`
5. `php artisan key:generate`
6. `php artisan migrate --seed`
7. `php artisan serve`

Opcional: restaurar los datos de ejemplo con `database/dump/agencia_viaje.sql`.

## Usuarios de prueba
- Administrador: admin@agencia.com
- Usuario: registrarse desde la página de inicio

## Funcionalidades
- Login y registro (Laravel Breeze)
- Roles: admin y usuario
- CRUD de destinos y paquetes (solo admin)
- Búsqueda de destinos, paquetes y catálogo
- Reservaciones con control de cupos (usuarios)
- Cancelación de reservaciones con devolución de cupos