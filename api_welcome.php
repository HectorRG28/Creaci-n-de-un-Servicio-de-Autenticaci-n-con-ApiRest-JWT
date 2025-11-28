<?php
// GET /api/welcome: Responde con datos del usuario si el token es válido. [cite: 81]
header('Content-Type: application/json');

// 1. Obtener la cabecera Authorization
$headers = getallheaders();
$auth_header = $headers['Authorization'] ?? '';

// 2. Verificar si el token está presente
if (empty($auth_header) || !preg_match('/Bearer\s(\S+)/', $auth_header, $matches)) {
    // Si no está, responder con 403 Forbidden (No tienes permisos) [cite: 67, 68]
    http_response_code(403);
    echo json_encode(["error" => "Acceso denegado. Token de autenticación requerido."]);
    exit;
}

$token = $matches[1]; // El token es el segundo elemento del array $matches

// 3. "Validar" el token (decodificar y verificar expiración)
try {
    $payload_json = base64_decode($token); // Decodificar el "JWT" simple
    $payload = json_decode($payload_json, true);

    // Verificar si el payload se decodificó correctamente y contiene la expiración
    if (!$payload || !isset($payload['username']) || !isset($payload['exp'])) {
        throw new Exception("Token inválido o malformado.");
    }

    // Verificar expiración
    if ($payload['exp'] < time()) {
        throw new Exception("Token expirado.");
    }

    $username = $payload['username'];

    // 4. Si el token es válido, responder con los datos del usuario [cite: 81]
    http_response_code(200);
    echo json_encode([
        "status" => "ok",
        "username" => $username,
        "current_time" => date('Y-m-d H:i:s')
    ]);

} catch (Exception $e) {
    // 5. Si la validación falla (ej: token inválido/expirado), responder con 403 Forbidden [cite: 67, 68]
    http_response_code(403);
    echo json_encode(["error" => "Token inválido. " . $e->getMessage()]);
    exit;
}
?>