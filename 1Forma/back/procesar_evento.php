<?php
// =====================================================================
// procesar_evento.php
// Archivo encargado de recibir los datos enviados por POST desde el
// formulario de registro del evento y mostrar un recibo con Bootstrap.
// Incluye validaciones y procesamiento de archivo adjunto.
// =====================================================================

// Comprobamos que la petición es de tipo POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    echo "<h2 style='color:red;'>Error: Acceso no permitido</h2>";
    exit();
}

// --------------------------
// Recuperación de datos POST
// --------------------------

$nombre       = $_POST['nombre'] ?? "";
$email        = $_POST['email'] ?? "";
$telefono     = $_POST['telefono'] ?? "";
$nacimiento   = $_POST['nacimiento'] ?? "";
$genero       = $_POST['genero'] ?? "No especifica";

$fechaEvento  = $_POST['fecha_evento'] ?? "";
$entrada      = $_POST['entrada'] ?? "";

$comidas      = $_POST['comida'] ?? [];   // Array checkbox

$usuario      = $_POST['usuario'] ?? "";
$password     = $_POST['password'] ?? "";
$password2    = $_POST['password2'] ?? "";

$notificaciones = isset($_POST['notificaciones']) ? "Sí" : "No";
$terminos       = isset($_POST['terminos']) ? "Aceptados" : "No aceptados";

$calificacion = $_POST['calificacion'] ?? "Sin valorar";
$comentarios  = $_POST['comentarios'] ?? "Sin comentarios";

// --------------------------
// Validación obligatoria
// --------------------------

$errores = [];

// Validación de contraseña
if ($password !== $password2) {
    $errores[] = "Las contraseñas no coinciden";
}

// Validación de términos
if ($terminos !== "Aceptados") {
    $errores[] = "Debes aceptar los términos y condiciones para continuar";
}

// Procesamiento del archivo subido
$nombreArchivo = "";
if (isset($_FILES['archivo']) && $_FILES['archivo']['error'] === 0) {
    $nombreArchivo = basename($_FILES['archivo']['name']);
    $rutaTemp = $_FILES['archivo']['tmp_name'];

    // Creamos carpeta uploads si no existe
    if (!is_dir('uploads')) {
        mkdir('uploads', 0777, true);
    }

    // Guardamos el archivo en uploads
    move_uploaded_file($rutaTemp, "uploads/$nombreArchivo");
} else {
    $nombreArchivo = "No se subió archivo";
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos recibidos</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light">
<div class="container mt-5 p-4 bg-white shadow rounded">

    <h1 class="text-center mb-4">Recibo de Registro del Evento</h1>

    <?php if (count($errores) > 0): ?>
        <!-- Mostrar mensajes de error -->
        <div class="alert alert-danger">
            <h4>Se encontraron errores en el envío del formulario:</h4>
            <ul>
                <?php foreach ($errores as $error): ?>
                    <li><?= htmlspecialchars($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <!-- Botón para volver al formulario -->
        <a href="index.html" class="btn btn-secondary mt-2">Volver al formulario</a>

    <?php else: ?>

        <div class="alert alert-success">
            <h4>Registro completado correctamente</h4>
        </div>

        <!-- Mostrar información recibida -->
        <h3>Información Personal</h3>
        <ul>
            <li><strong>Nombre:</strong> <?= htmlspecialchars($nombre) ?></li>
            <li><strong>Email:</strong> <?= htmlspecialchars($email) ?></li>
            <li><strong>Teléfono:</strong> <?= htmlspecialchars($telefono) ?></li>
            <li><strong>Fecha de Nacimiento:</strong> <?= htmlspecialchars($nacimiento) ?></li>
            <li><strong>Género:</strong> <?= htmlspecialchars($genero) ?></li>
        </ul>

        <h3>Información del Evento</h3>
        <ul>
            <li><strong>Fecha del Evento:</strong> <?= htmlspecialchars($fechaEvento) ?></li>
            <li><strong>Entrada:</strong> <?= htmlspecialchars($entrada) ?></li>
            <li><strong>Comida:</strong>
                <?php
                if (!empty($comidas)) {
                    echo implode(", ", array_map('htmlspecialchars', $comidas));
                } else {
                    echo "Sin preferencias";
                }
                ?>
            </li>
        </ul>

        <h3>Acceso</h3>
        <ul>
            <li><strong>Usuario:</strong> <?= htmlspecialchars($usuario) ?></li>
            <li><strong>Contraseña:</strong> ******** (oculta por seguridad)</li>
        </ul>

        <h3>Preferencias</h3>
        <ul>
            <li><strong>Notificaciones Email:</strong> <?= htmlspecialchars($notificaciones) ?></li>
            <li><strong>Términos y Condiciones:</strong> <?= htmlspecialchars($terminos) ?></li>
        </ul>

        <h3>Encuesta y Archivo</h3>
        <ul>
            <li><strong>Calificación:</strong> <?= htmlspecialchars($calificacion) ?></li>
            <li><strong>Comentarios:</strong> <?= nl2br(htmlspecialchars($comentarios)) ?></li>
            <li><strong>Archivo subido:</strong> <?= htmlspecialchars($nombreArchivo) ?></li>
        </ul>

        <a href="index.html" class="btn btn-primary mt-3">Volver</a>

    <?php endif; ?>

</div>
</body>
</html>
