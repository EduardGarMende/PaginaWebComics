<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../models/conectaBD.php';
require_once __DIR__ . '/../models/carrito.php';

header('Content-Type: application/json');

$id_usuari = $_SESSION['id_usuari'];
$db = conectaDB();

// Obtener resumen del carrito
$resumen = obtenerResumenCarrito($db, $id_usuari);

echo json_encode([
    'status' => 'success',
    'numeroProductos' => $resumen['numeroProductos'],
    'precioTotal' => number_format($resumen['precioTotal'], 2, ',', '.'),
]);