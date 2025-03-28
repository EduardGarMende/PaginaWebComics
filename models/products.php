<?php
function getProductsByCategory($db, $id_categoria, $limit = 4) {
    $sql = "SELECT id_prod, nom, img, preu FROM producte WHERE id_categoria = $1 LIMIT $2";
    $consulta = pg_query_params($db, $sql, array($id_categoria, $limit));
    $productos = pg_fetch_all($consulta);
    return $productos;
}

function getProductById($conexio, $id_prod) {
    $sql = "SELECT id_prod, nom, img, preu, autor, descripcio_corta, actiu, isbn, tapa, data_edicio, n_pagines, peso, descripcio FROM producte WHERE id_prod = $1";
    $consulta = pg_query_params($conexio, $sql, array($id_prod)) or die("Error al obtener el producto");
    $producto = pg_fetch_all($consulta);
    return $producto[0];
}

function buscarProductos($connexio, $query) {
    $sql = "SELECT id_prod, nom, img, preu FROM producte WHERE nom ILIKE $1 OR descripcio ILIKE $1";
    $consulta = pg_query_params($connexio, $sql, array('%' . $query . '%')) or die("Error al buscar productos.");
    $productos = pg_fetch_all($consulta);
    return $productos;
}
?>