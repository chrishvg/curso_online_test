# permision_test

Esto es solo un proyecto de prueba sobre cursos online en Laravel.

## Requisitos

- PHP 8.2+
- Composer
- Npm

## Instalación

Sigue estos pasos para configurar el proyecto en tu entorno local:

1. **Clona el repositorio**

   Abre tu terminal y ejecuta el siguiente comando:

   ```bash
   git clone https://github.com/chrishvg/curso_online_test.git

   cd user_task_permissions

   ```
   
2. **Instala las dependencias**

   Abre tu terminal y ejecuta el siguiente comando:

   ```bash
   composer install
   npm install
   php artisan migrate
   ```

3. **(opcional) Ejecuta los tests**

    ```bash
    php artisan test
    ```

4. **Ejecuta los seeders**

   Abre tu terminal y ejecuta el siguiente comando:

   ```bash
   php artisan db:seed --class=RoleSeeder && php artisan db:seed --class=CategorySeeder && php artisan db:seed --class=AdminSeeder
    ```

5. **Ejecuta el proyecto**

    ```bash
    php artisan serve
    ```

   Esto levantará el servidor en http://localhost:8000

6. **Acceso**

   Puedes acceder a la aplicación usando las siguientes credenciales:

   ```bash
    Usuario: admin@admin.com
    Contraseña: password
   ```
    
