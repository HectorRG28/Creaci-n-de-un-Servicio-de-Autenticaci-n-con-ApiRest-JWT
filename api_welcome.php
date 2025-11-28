<?php
//Respondo con los datos al usuario si el token es válido
header('Content-Type: application/json');

//Obtengo la autorización del cabecera
$headers = getallheaders();
$auth_header = $headers['Authorization'] ?? '';

// Verificar si existe token
if (empty($auth_header) || !preg_match('/Bearer\s(\S+)/', $auth_header, $matches)) {
    // Si no está respondo con prohibido
    http_response_code(403);
    echo json_encode(["error" => "Acceso denegado. Token de autenticación requerido."]);
    exit;
}

$token = $matches[1];//El token es el segundo elemento array

// Valido el token y verifico la expiración
try {
    $payload_json = base64_decode($token); // Decodifico el JWT
    $payload = json_decode($payload_json, true);

    //Verifico el payload
    if (!$payload || !isset($payload['username']) || !isset($payload['exp'])) {
        throw new Exception("Token inválido o malformado.");
    }

    // Verifico la expiración
    if ($payload['exp'] < time()) {
        throw new Exception("Token expirado.");
    }

    $username = $payload['username'];

    // Si el token es correcto, respondo con los datos del usuario
    http_response_code(200);
    echo json_encode([
        "status" => "ok",
        "username" => $username,
        "current_time" => date('Y-m-d H:i:s')
    ]);

} catch (Exception $e) {
    // Si la conexión falla o el token ha expirado da error
    http_response_code(403);
    echo json_encode(["error" => "Token inválido. " . $e->getMessage()]);
    exit;
}
?>