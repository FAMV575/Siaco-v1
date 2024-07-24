<?php
// Configurar cabeceras CORS
header("Access-Control-Allow-Origin: http://localhost:3000");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS");

// Simular autenticación básica
$input = json_decode(file_get_contents('php://input'), true);

$username = $input['username'];
$password = $input['password'];

// Validar las credenciales (simulado para ejemplo)
if ($username === 'usuario' && $password === 'contraseña') {
    // Usuario autenticado correctamente
    $response = array('success' => true, 'message' => 'Login exitoso');
} else {
    // Error de autenticación
    $response = array('success' => false, 'message' => 'Credenciales incorrectas');
}

// Devolver la respuesta como JSON
header('Content-Type: application/json');
echo json_encode($response);
?>
