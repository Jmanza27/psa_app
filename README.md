# PSA APP

Proyecto Presentado para Oferta Laboral Desarrollador BackEnd

## Descripción

Este proyecto es una aplicación web desarrollada en Laravel que permite la gestión de empleados en una empresa. Los usuarios pueden crear, listar, actualizar y eliminar empleados de forma lógica, además de gestionar sus cargos y relaciones. La aplicación también incluye funcionalidades para seleccionar la ciudad de nacimiento basada en el país seleccionado.

### Características

- **Gestión de empleados**: Crear, listar, actualizar y eliminar empleados.
- **Relaciones entre modelos**: Implementación de relaciones entre empleados y cargos.
- **Validaciones de formulario**: Asegura que los datos ingresados sean correctos.
- **Interfaz de usuario responsiva**: Utiliza Bootstrap para un diseño atractivo y adaptable.
- **Uso de migraciones**: Gestión de la base de datos utilizando migraciones de Laravel.

## Tecnologías

- Laravel 8
- PHP
- SQLite (o PostgreSQL)
- Bootstrap
- Blade

## Instalación

1. Clona este repositorio:
   ```bash
   git clone https://github.com/Jmanza27/psa_app.git
2. Ingresa a la Carpeta
    ```bash
   cd psa_app
4. Instalar el Composer
    ```bash
    composer install
5. Configurar el Archivo .env
    ```bash
    cp .env.example .env
6. Ejecutar Migracion
    ```bash
    php artisan migrate
7. Ejecutar Seeder
    ```bash
    php artisan db:seed --class=InsertSeeder
8. Iniciar Servidor
    ```bash
    php artisan serve
