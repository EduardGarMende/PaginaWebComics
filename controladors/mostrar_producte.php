<?php

require_once __DIR__ . '/../models/conectaBD.php';
require_once __DIR__ . '/../models/products.php';

$producte_id = $_GET['id'] ?? null;

if (!$producte_id) {
    die('Producto no especificado');
}

$db = conectaDB();

$product = getProductById($db ,$producte_id);

if (!$product) {
    die('Producto no encontrado.');
}

include __DIR__ . '/../vistes/vista_producte.php';