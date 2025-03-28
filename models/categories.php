<?php
function getCategories($db): array
{
    $sql = "SELECT id_categoria, nom FROM categoria";
    $consulta = pg_query($db, $sql);
    $categories = pg_fetch_all($consulta);
    return $categories;
}
?>