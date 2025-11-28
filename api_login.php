<?php
// POST /api/login: Valida credenciales y devuelve un token. [cite: 80]
header('Content-Type: application/json');

// 1. Array predefinido de usuarios para simular la BDD [cite: 88, 89, 90, 91]
$usuarios = [
    ["username" => "admin", "password" => "1234"],
    ["username" => "user", "password" => "abcd"]
];

// 2. Recibir los datos del formulario (JSON)
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

// 3. Validar credenciales [cite: 57]
if (!$authenticated_user) {
    // 4. Si son incorrectas, responder con 401 Unauthorized [cite: 59]
    http_response_code(401);
    echo json_encode(["error" => "Credenciales incorrectas. Usuario o contraseña no válidos."]);
    exit;
}

// 5. Generar un "token" (cadena generada con base64_encode para simular JWT) [cite: 58]
// En un entorno real se usaría una librería JWT. Aquí es una simulación simple.
$payload = json_encode([
    'username' => $authenticated_user['username'],
    'iat' => time(),
    'exp' => time() + (3600 * 24) // Expira en 24 horas
]);
$token = base64_encode($payload); // Token simple [cite: 58]

// 6. Responder con el token [cite: 58]
http_response_code(200);
echo json_encode([
    "message" => "Autenticación exitosa",
    "token" => $token
]);
?>