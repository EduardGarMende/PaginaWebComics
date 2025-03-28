<?php
require_once __DIR__ . '/../models/conectaBD.php';
require_once __DIR__ . '/../models/carrito.php';

if (!isset($_SESSION['id_usuari'])) {
    echo "Debes iniciar sesión para ver tu carrito.";
    exit;
}

$id_usuari = $_SESSION['id_usuari'];
$db = conectaDB();

// Obtener los productos del carrito del usuario
$productosCarrito = obtenerCarrito($db, $id_usuari);

include __DIR__ . '/../vistes/carrito.php';
?>