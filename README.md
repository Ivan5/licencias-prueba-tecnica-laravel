# Licencias

## Prueba técnica para **HD Latinoamerica**

### Una vez se descargue o se clone el repositorio, se deben hacer las siguientes instrucciones.

1.- `composer install` para poder instalar las dependecias que se requieren.

2.- Se debe crear una base de datos en el servidor local de 'MySQL' y hacer la referencia dentro del archivo `.env` en la variable `DB_DATABASE`

3.- `php artisan migrate` para poder generar las migraciones de las tablas a la base de datos.

4.- `php artisan serve ` para iniciar el servidor.

> Nota: Se require tener instalado composer aparte de php.

## Los archivos creados para esta prueba son los siguientes :

-   `./app/Http/Controllers/LicenciasController.php` : El controlador de licencias, que se encarga de la gestión de las peticiones a la api y la BD, así como la gestión de las vistas.

-   `./app/Licencia.php` : Representa el modelo de licencias, que es la estructura que tendra cada instancia de la misma.

-   `./database/migrations/2021_02_04_180315_create_licencias_table.php` : Este archivo representa la migración para la creación de la tabla licencias en la base de datos,contiene los atributos y el tipo de dato de cada uno de ellos.

-   `./public/css/app.css` : Contiene los estilos requeridos para la prueba.

-   `./resources/views/licencias` : Folder con los archivos necesarios para la vista y las acciones que se ejecutan.

-   `./routes/web.php` : Archivo con las rutas necesarias.

> Nota: Cada uno de los archivos mencionados están documentados.

> Se incluye también el archivo de base de datos en un archivo .slq llamado licencias_test.slq
