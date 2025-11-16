<?php
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    echo json_encode(["error" => "Método no permitido"]);
    exit;
}

$input = json_decode(file_get_contents("php://input"), true);

if (!$input) {
    echo json_encode(["error" => "JSON inválido"]);
    exit;
}

// Validaciones básicas
if (empty($input["email"]) || empty($input["pass"])) {
    echo json_encode(["error" => "Campos obligatorios vacíos"]);
    exit;
}

if ($input["pass"] !== $input["pass2"]) {
    echo json_encode(["error" => "Las contraseñas no coinciden"]);
    exit;
}

// Respuesta simulando resultado OK
echo json_encode([
    "mensaje" => "Registro realizado correctamente",
    "usuario" => $input["usuario"],
    "entrada" => $input["entrada"]
]);
?>
