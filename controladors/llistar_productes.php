<?php

require_once __DIR__ . '/../models/conectaBD.php';
require_once __DIR__ . '/../models/products.php';

$categoria_id = intval($_GET['id_categoria']) ?? null;

if (!$categoria_id) {
    die('Categoria no especificado');
}

$db = conectaDB();

$product = getProductsByCategory($db, $categoria_id, 40);

if (!$product) {
    die('Productos no encontrados.');
}

include __DIR__ . '/../vistes/llistar_productes.php';