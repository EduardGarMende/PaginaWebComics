<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../models/conectaBD.php';
require_once __DIR__ . '/../models/carrito.php';

if (!isset($_SESSION['id_usuari'])) {
    echo "Debes iniciar sesión para ver tus pedidos.";
    exit;
}

$id_usuari = $_SESSION['id_usuari'];
$db = conectaDB();

$pedidos = obtenerPedidosConProductos($db, $id_usuari);

include __DIR__ . '/../vistes/ver_pedidos.php';
?>