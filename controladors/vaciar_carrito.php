<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../models/conectaBD.php';
require_once __DIR__ . '/../models/carrito.php';

if (!isset($_SESSION['id_usuari'])) {
    echo json_encode(['status' => 'error', 'message' => 'Debes iniciar sesión para realizar esta acción.']);
    exit;
}

$id_usuari = $_SESSION['id_usuari'];
$db = conectaDB();

// Comprobar la acción solicitada
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['accio'])) {
    if ($_GET['accio'] === 'vaciar_carrito') {
        // Acció per buidar el carretó
        if (vaciarCarrito($db, $id_usuari)) {
            echo json_encode(['status' => 'success', 'message' => 'El carrito se ha vaciado correctamente.']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'No se pudo vaciar el carrito.']);
        }
        exit;
    }
}

// Obtener los productos del carrito del usuario
$productosCarrito = obtenerCarrito($db, $id_usuari);

include __DIR__ . '/../vistes/carrito.php';
?>
