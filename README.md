# Gestor de Ideas Laravel

Este proyecto es una aplicación web desarrollada con Laravel para gestionar ideas. Permite a los usuarios registrarse, iniciar sesión, crear, ver, editar y eliminar ideas, así como dar "me gusta" a las ideas de otros usuarios.

## Características principales
- Registro y autenticación de usuarios
- Creación, edición y eliminación de ideas
- Listado de ideas recientes y filtrado por usuario o popularidad
- Sistema de likes para ideas
- Interfaz moderna con Tailwind CSS y Vite

## Instalación y uso rápido

1. Clona el repositorio y entra en la carpeta del proyecto:
   ```powershell
   git clone <url-del-repo>
   cd GestorIdeasLaravel
   ```
2. Instala las dependencias de PHP:
   ```powershell
   composer install
   ```
3. Instala las dependencias de Node.js:
   ```powershell
   npm install
   ```
4. Copia el archivo de entorno y genera la clave:
   ```powershell
   copy .env.example .env
   php artisan key:generate
   ```
5. Configura tu base de datos en el archivo `.env`.
6. Ejecuta las migraciones y seeders para tener datos de ejemplo:
   ```powershell
   php artisan migrate --seed
   ```
7. Inicia el servidor de desarrollo de Laravel:
   ```powershell
   php artisan serve
   ```
8. En otra terminal, inicia Vite para los assets:
   ```powershell
   npm run dev
   ```
9. Accede a la app en [http://localhost:8000](http://localhost:8000)

## Usuarios de ejemplo
Se crean 5 usuarios con contraseña `password` y varias ideas de ejemplo. Puedes iniciar sesión con cualquiera de los correos generados en la base de datos.

---

¡Listo para tu portfolio! Si tienes dudas o quieres personalizarlo más, revisa las rutas y vistas en `routes/web.php` y `resources/views/`.
