<?php
require_once __DIR__ . '/../models/conectaBD.php';      // Conexión a la base de datos
require_once __DIR__ . '/../models/categories.php';      // Modelo para obtener categorías
require_once __DIR__ . '/../models/products.php';        // Modelo para obtener productos de una categoría

$db = conectaDB();

// Obtiene las categorías desde el modelo
$categories = getCategories($db);

$categories_with_products = [];

foreach ($categories as $category) {
    $category['producte'] = getProductsByCategory($db, $category['id_categoria'], 4);
    $categories_with_products[] = $category;
}

include __DIR__ . '/../vistes/llistar_categories.php';
?>