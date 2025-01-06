<?php
require_once "clothe.php";

// Permitir solicitudes CORS
header("Access-Control-Allow-Origin: http://localhost:4200"); 
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

// Responder a la solicitud OPTIONS
if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    // Enviar una respuesta vacía para las solicitudes OPTIONS
    http_response_code(200);
    exit();
}

switch ($_SERVER['REQUEST_METHOD']) {
    case 'GET':
        echo json_encode(Clothe::get_all());
    break;

    case 'POST':
        $data = json_decode(file_get_contents('php://input'), true);
        if ($data !== null) {
            if (Clothe::create_resource($data['name'], $data['color'], $data['type'])) {
                http_response_code(201); // Creación exitosa
            } else {
                http_response_code(500); // Error en el servidor
            }
        } else {
            http_response_code(400); // Error en los datos enviados
        }
    break;

    default:
        http_response_code(405); // Método no permitido
    break;
}
