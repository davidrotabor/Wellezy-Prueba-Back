# Backend - Agencia de Vuelos Wellezy

Este es un proyecto de backend desarrollado con Laravel 11 como prueba técnica para la agencia de vuelos Wellezy. Este backend proporciona servicios API para la gestión de vuelos, incluyendo búsquedas, itinerarios y reservaciones.

## Requisitos

- **PHP** (versión 8.1 o superior)
- **Composer** (gestor de dependencias de PHP)
- **Servidor de base de datos** (MySQL recomendado)
- **Node.js y npm** (para manejar algunas dependencias del frontend de Laravel)

## Instalación y Configuración


```bash
# Clona el repositorio
git clone https://github.com/davidrotabor/Wellezy-Prueba-Back.git

# Ingresa al directorio del proyecto
cd Wellezy-Prueba-Back

# Instala las dependencias de PHP
composer install

# Copia el archivo de entorno
cp .env.example .env

# Genera la clave de aplicación
php artisan key:generate

# Este comando creará las tablas necesarias en tu base de datos
php artisan migrate

# Para iniciar el servidor de desarrollo de Laravel, utiliza
php artisan serve

# Generar la documentación
php artisan l5-swagger:generate
```

## Acceder a la documentación

En el navegador abre http://localhost:8000/documentation

