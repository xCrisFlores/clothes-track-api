<?php
require_once "clothe.php";

header("Access-Control-Allow-Origin: http://localhost:4200"); 
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Authorization, X-Requested-With");

if ($_SERVER['REQUEST_METHOD'] == 'OPTIONS') {
    
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
                http_response_code(201); 
            } else {
                http_response_code(500); 
            }
        } else {
            http_response_code(400); 
        }
    break;

    case 'PUT':
    
        $data = json_decode(file_get_contents('php://input'), true);
        if (isset($data['id'])) {

            $id = $data['id'];  

            if (Clothe::setUsed($id)) {
                http_response_code(200);
            } else {
                http_response_code(500); 
            }
        } else {
            http_response_code(400); 
        }
    break;

    case 'DELETE':
        
        if (isset($_GET['id'])) {

            $id = $_GET['id'];  

            if (Clothe::deleteClothe($id)) {
                http_response_code(200); 
            } else {
                http_response_code(500);
            }
        } else {
            http_response_code(400); 
        }
        break;

    default:
        http_response_code(405); 
    break;
}
