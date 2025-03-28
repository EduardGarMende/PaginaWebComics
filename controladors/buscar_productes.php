<?php
require_once __DIR__ . '/../models/conectaBD.php';
require_once __DIR__ . '/../models/products.php';

$query = $_GET['query'] ?? '';

if (!$query) {
    echo "<p>Por favor, ingresa un término de búsqueda.</p>";
    exit;
}

$db = conectaDB();

$product = buscarProductos($db, $query);

include __DIR__ . '/../vistes/llistar_productes.php';