<?php
header('Content-Type: application/json'); 
if (isset($_GET['id'])) {
    $status = $_GET['id'];
    http_response_code(200); // OK
    echo json_encode(["status" => $status, "message" => "Producto encontrado."]);
} else {
    http_response_code(400); // Bad Request
    echo json_encode(["error" => "Faltan parámetros."]);
}
?>