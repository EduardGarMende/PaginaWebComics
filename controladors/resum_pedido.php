<?php
require_once __DIR__ . '/../models/conectaBD.php';
require_once __DIR__ . '/../models/carrito.php';

if (!isset($_GET['id_pedido'])) {
    echo "No se encontró el pedido.";
    exit;
}

$id_pedido = $_GET['id_pedido'];
$db = conectaDB();

$pedido = obtenerPedido($db, $id_pedido);
$productos = obtenerDetallePedido($db, $id_pedido);

if (!$pedido || !$productos) {
    die("Error al recuperar los datos del pedido.");
}

include __DIR__ . '/../vistes/resum_pedido.php';
?>