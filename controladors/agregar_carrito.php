<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../models/conectaBD.php';
require_once __DIR__ . '/../models/carrito.php';

header('Content-Type: application/json'); // Asegurar respuesta JSON

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id_usuari = $_SESSION['id_usuari'] ?? null;

    if (!$id_usuari) {
        echo json_encode(['status' => 'error', 'message' => 'Debe iniciar sesión para añadir productos a la cesta.']);
        exit;
    }

    // Decodificar el cuerpo de la solicitud JSON
    $data = json_decode(file_get_contents('php://input'), true);

    $id_prod = $data['id_prod'] ?? null;
    $quantitat = $data['quantitat'] ?? 1; // Valor predeterminado: 1

    if (!$id_prod) {
        echo json_encode(['status' => 'error', 'message' => 'Producto no especificado.']);
        exit;
    }

    $db = conectaDB();
    $resultado = agregarProductoCarrito($db, $id_usuari, $id_prod, $quantitat);

    if ($resultado) {
        echo json_encode(['status' => 'success', 'message' => 'Producto agregado al carrito.']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Error al agregar el producto al carrito.']);
    }
}
?>