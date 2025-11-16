Información de la actividad

    Módulo: DWEC – Desarrollo Web en Entorno Cliente
    Profesor: Carlos Basulto Pardo
    Curso: Desarrollo de Aplicaciones Multiplataforma/Web
    RA3 - AEE: Creación de un formulario completo para una aplicación de registro de eventos

    Objetivo: Crear un formulario HTML validado con Bootstrap, y procesarlo de dos formas:

        1. Método tradicional enviando por POST a un archivo PHP.
        2. Método REST enviando JSON mediante fetch() a un endpoint PHP (API).

Contenido del proyecto

    El proyecto está dividido en dos implementaciones, cada una en su propia carpeta.

    FORMA 1 — Envío tradicional por POST
    Estructura

        1Forma/
        ├── front/
        │    ├── index.html
        └── back/
            └── procesar_evento.php

    Descripción
        En esta primera versión el formulario se envía de manera tradicional usando:
            
            <form action="../back/procesar_evento.php" method="POST" enctype="multipart/form-data">

El archivo procesar_evento.php:

Recupera todos los campos usando $_POST.

Valida datos esenciales (email, contraseña, aceptación de términos…).

Muestra un recibo formateado con Bootstrap usando echo.

Incluye validación HTML5 (required, type=email, etc.).

Incluye estilos de Bootstrap (form-control, form-group, etc.).

✔ Funcionalidades obligatorias incluidas

Campos obligatorios validados con Bootstrap y HTML5

Métodos POST

Arrays (checkbox de comidas)

Uso de decisiones (if)

Renderizado final de datos enviados

Comentarios en el código

Adjuntar archivo (input type="file")

Diseño completo y organizado por secciones

🟩 FORMA 2 — Envío mediante llamadas REST (Fetch POST / JSON)
📁 Estructura
forma2/
 ├── front/
 │    ├── index_rest.html
 │    ├── script.js
 └── back/
      └── api_evento.php

📘 Descripción

En esta versión se sustituye el envío clásico del formulario por una llamada REST que envía los datos en formato JSON a un endpoint PHP.

El formulario no utiliza action ni method:

<form id="form-evento">


Toda la lógica se realiza desde script.js:

✔ Funcionamiento REST

Se captura el evento submit.

Se usa preventDefault() para evitar recargar la página.

Se recopilan todos los datos del formulario.

Se envían mediante:

fetch("../back/api_evento.php", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify(datos)
});

✔ Backend (API REST)

El archivo api_evento.php:

Detecta si la petición es POST.

Recibe JSON usando php://input.

Decodifica con json_decode().

Valida campos (email, contraseñas…).

Responde en JSON:

{
  "mensaje": "Registro realizado correctamente",
  "usuario": "valor",
  "entrada": "valor"
}

✔ Resultado

El usuario recibe un mensaje vía:

alert(resultado.mensaje);

🛠 Tecnologías utilizadas

HTML5

CSS3

Bootstrap 5.3

JavaScript (Fetch API)

PHP 8 (compatible 7.x)

JSON

Validación HTML y validación en backend

🚀 Cómo ejecutar el proyecto
▶ Forma 1 (POST tradicional)

Copiar forma1 a tu servidor local (XAMPP, Laragon…).

Abrir en navegador:

http://localhost/forma1/index.html


Enviar formulario → ver recibo generado en procesar_evento.php.

▶ Forma 2 (REST POST)

Copiar forma2 dentro del servidor local.

Importante: mantener las carpetas front y back.

Abrir en navegador:

http://localhost/forma2/front/index_rest.html


Enviar formulario con REST → aparecerá un alert con respuesta de la API.

📝 Competencias trabajadas

Programación estructurada

Tomas de decisión (if / else)

Bucles y arrays

Validación cliente/servidor

Creación de formularios web completos

Uso de métodos POST (clásico y REST)

Interacción con el usuario mediante DOM y JS

Manejo de JSON

Integración front–back (REST)

✔ Conclusión

La actividad incluye dos formas de procesar el formulario:

FORMA 1: envío tradicional por POST → procesar y mostrar recibo.

FORMA 2: envío mediante REST con JSON → mostrar respuesta dinámica.

Ambas cumplen los requisitos marcados por el profesor y demuestran el dominio del flujo cliente–servidor.