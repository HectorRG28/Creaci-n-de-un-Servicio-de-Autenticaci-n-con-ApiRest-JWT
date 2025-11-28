<?php
//Método post que valida las credenciales
header('Content-Type: application/json');

// Array para la simulación de la base de datos
$usuarios = [
    ["username" => "admin", "password" => "1234"],
    ["username" => "user", "password" => "abcd"]
];

// Recibo de datos del formularion con JSON
$input_data = json_decode(file_get_contents("php://input"), true);

$username = $input_data['username'] ?? '';
$password = $input_data['password'] ?? '';

$authenticated_user = null;
foreach ($usuarios as $user) {
    if ($user['username'] === $username && $user['password'] === $password) {
        $authenticated_user = $user;
        break;
    }
}

// Valido los datos
if (!$authenticated_user) {
    // Si es incorrecto da error
    http_response_code(401);
    echo json_encode(["error" => "Credenciales incorrectas. Usuario o contraseña no válidos."]);
    exit;
}

// Genero un token
$payload = json_encode([
    'username' => $authenticated_user['username'],
    'iat' => time(),
    'exp' => time() + (3600 * 24) //Deja de sar válido tras 24 horas
]);
$token = base64_encode($payload); // Token simple 

// Respondo con el token
http_response_code(200);
echo json_encode([
    "message" => "Autenticación exitosa",
    "token" => $token
]);
?>