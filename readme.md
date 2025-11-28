# RA4. AEE: Creación de un Servicio de Autenticación con ApiRest JWT

**Módulo Profesional:** Desarrollo Web en Entorno Servidor 

##  Objetivo
Crear una web básica con un servicio de autenticación con JWT

## Características Implementadas
1.  **Pantalla de Login (`index.html`):** Formulario para poner usuario y contraseña
2.  **API RESTful (`api_login.php`):** Endpoint y validacion de tokens
3.  **Pantalla de Bienvenida (`welcome.html`):** Acceso protegido y solo accesible tras la validación positiva del token proporcionado
4.  **Pantalla de "No Tienes Permisos" (`forbidden.html`):** Redirección automática a prohibido
5.  **Funcionalidad Cerrar Sesión:** Botón que elimina el token y vuelve al login

## Requisitos Técnicos
* **API PHP:**Uso de JSON encode para las respuestas de JSON
* **Manejo de Sesiones en Cliente:** Uso de localstorage para guardar el token y de la cabecera autorización
* **Validación:** Array para los usuarios (admin y user)
* **Redirecciones en Cliente:** Manejo de código de error y redirecciones

##  Uso
1.  Servidor Xampp para vista de archivos php
2.  Inicia tu navegador sustituyendo dashboard por el nombre de la carpeta raiz y en el siguiente ramal el archivo que desee.