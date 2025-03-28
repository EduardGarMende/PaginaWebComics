<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../models/conectaBD.php';
require_once __DIR__ . '/../models/carrito.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id_carrito = $data['id_carrito'] ?? null;
    $quantitat = $data['quantitat'] ?? null;

    if (!$id_carrito || !$quantitat || $quantitat < 1) {
        echo json_encode(['status' => 'error', 'message' => 'Datos inválidos.']);
        exit;
    }
    
    $db = conectaDB();
    $resultado = actualizarCantidadCarrito($db, $id_carrito, $quantitat);

    if ($resultado) {
        echo json_encode(['status' => 'success', 'message' => 'Cantidad actualizada correctamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al actualizar la cantidad.']);
    }
}
?>