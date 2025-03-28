<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../models/conectaBD.php';
require_once __DIR__ . '/../models/carrito.php';

header('Content-Type: application/json'); // Asegura que la respuesta es JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);
    $id_carrito = $data['id_carrito'] ?? null;

    if (!$id_carrito) {
        echo json_encode(['status' => 'error', 'message' => 'ID de carrito no especificado.']);
        exit;
    }

    $db = conectaDB();
    $resultado = eliminarProductoCarrito($db, $id_carrito);

    if ($resultado) {
        echo json_encode(['status' => 'success', 'message' => 'Producto eliminado correctamente.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al eliminar el producto.']);
    }
}
?>