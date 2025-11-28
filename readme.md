# RA4. AEE: Creación de un Servicio de Autenticación con ApiRest JWT

**Módulo Profesional:** Desarrollo Web en Entorno Cliente (DWEC)

## 🎯 Objetivo
Crear una aplicación web básica que implemente un sistema de autenticación mediante una API RESTful con JWT (simulado con base64_encode para el token y utilizando una estructura simple de usuarios en PHP).

## ✨ Características Implementadas
1.  **Pantalla de Login (`index.html`):** Formulario para introducir Nombre de usuario y Contraseña. Usa `fetch` para enviar credenciales a `/api_login.php`.
2.  **API RESTful (`api_login.php`):**
    * Endpoint `/api/login` (simulado por `api_login.php`).
    * Valida credenciales contra un array PHP predefinido.
    * Si es correcto, devuelve un token simple (cadena Base64) y redirige a `welcome.html`.
    * Si es incorrecto, responde con **401 Unauthorized**.
3.  **Pantalla de Bienvenida (`welcome.html`):**
    * Acceso protegido, requiere un token en la cabecera `Authorization: Bearer <token>`.
    * Llama al endpoint `/api_welcome.php` para obtener datos del usuario.
    * Muestra mensaje de bienvenida, nombre de usuario y hora actual.
4.  **Pantalla de "No Tienes Permisos" (`forbidden.html`):**
    * Redirección automática si `/api_welcome.php` responde con **403 Forbidden** (token ausente o inválido).
5.  **Funcionalidad Cerrar Sesión:**
    * Botón en `welcome.html` que elimina el token de `localStorage` y redirige a `index.html`.

## ⚙️ Requisitos Técnicos
* **API PHP:** Uso de `json_encode` para respuestas JSON.
* **Manejo de Sesiones en Cliente:** `localStorage` para almacenar y recuperar el token. Envío del token en la cabecera `Authorization: Bearer <token>`.
* **Validación:** Array predefinido de usuarios en PHP.
* **Redirecciones en Cliente:** Manejo de códigos de error HTTP **401/403** para redirigir a las pantallas correspondientes.

## 🚀 Uso
1.  Asegúrate de tener un servidor web local (como XAMPP, Laragon, o un servidor PHP simple) configurado para ejecutar los archivos PHP.
2.  Coloca todos los archivos en el directorio raíz de tu servidor.
3.  Accede a `index.html` en tu navegador.