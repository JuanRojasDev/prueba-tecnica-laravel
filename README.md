<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Prueba Técnica - Ingeniero Frontend (Grupo Alianza)

## Descripción

En **Grupo Alianza, PsicoAlianza y sus empresas aliadas**, buscamos mejorar la experiencia visual y funcional de nuestros productos. Por ello, estamos en la búsqueda de un **Ingeniero Frontend** con habilidades analíticas y creativas para desarrollar interfaces intuitivas y atractivas.

Esta prueba técnica tiene como objetivo evaluar tu capacidad para desarrollar un proyecto en **Laravel** con autenticación y consumo de API externa.

## 📌 Requisitos del Proyecto

### 🔹 Autenticación
- Implementar autenticación utilizando un paquete adecuado (ej.: Laravel Auth).
- Implementar la pantalla de **login** por defecto.
- Proteger las vistas necesarias.

### 🔹 Consumo de API Pública
- Utilizar la API pública de [TheCocktailDB](https://www.thecocktaildb.com/).
- Crear una vista que **liste los cócteles**, mostrando al menos **tres datos** por cóctel obtenidos de la API.
- Crear una tabla en la **base de datos** para almacenar los cócteles.
- Incluir un botón en cada elemento listado para **guardar los datos** del cóctel en la base de datos.
- Crear una vista adicional para **mostrar, editar y eliminar** los cócteles almacenados.

## ✅ Requisitos Indispensables
- Uso de un **framework de estilos** (Bootstrap, Tailwind, etc.).
- Diseño **responsive**.
- Uso de **jQuery**.

## ⭐ Requisitos Opcionales
- Crear un **repositorio público en Git** y realizar varios **commits** durante el desarrollo de la prueba.
- Utilizar librerías **JavaScript** de terceros como **Datatables, SweetAlert, etc.**

## 🎯 Criterios de Evaluación
- **Limpieza en el código**.
- **Funcionalidad adicional**.
- **Creatividad en la presentación de elementos gráficos**.

---

### 📂 Instalación y Configuración
1. Clona este repositorio:
   ```bash
   git clone https://github.com/tu-usuario/tu-repo.git
   ```
2. Instala las dependencias:
   ```bash
   composer install
   npm install
   ```
3. Configura el archivo `.env`:
   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nombre_de_tu_bd
   DB_USERNAME=tu_usuario
   DB_PASSWORD=tu_contraseña
   ```
4. Genera la clave de la aplicación:
   ```bash
   php artisan key:generate
   ```
5. Ejecuta las migraciones:
   ```bash
   php artisan migrate
   ```
6. Inicia el servidor:
   ```bash
   php artisan serve
   ```

¡Esperamos ver tu talento en acción! 🚀
