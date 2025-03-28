<?php
function agregarProductoCarrito($db, $id_usuari, $id_prod, $quantitat) {
    // Verificar si el producto ya está en el carrito
    $sql_check = "SELECT Quantitat FROM Carrito WHERE id_usuari = $1 AND id_prod = $2";
    $result_check = pg_query_params($db, $sql_check, array($id_usuari, $id_prod));

    if ($result_check && pg_num_rows($result_check) > 0) {
        // Si el producto ya está, actualizamos la cantidad
        $row = pg_fetch_assoc($result_check);
        $nueva_quantitat = $row['quantitat'] + $quantitat;

        $sql_update = "UPDATE Carrito SET Quantitat = $1 WHERE id_usuari = $2 AND id_prod = $3";
        $result_update = pg_query_params($db, $sql_update, array($nueva_quantitat, $id_usuari, $id_prod));

        return $result_update !== false;
    } else {
        // Si no está, lo añadimos
        $sql_insert = "INSERT INTO Carrito (id_usuari, id_prod, Quantitat) VALUES ($1, $2, $3)";
        $result_insert = pg_query_params($db, $sql_insert, array($id_usuari, $id_prod, $quantitat));

        return $result_insert !== false;
    }
}

function obtenerCarrito($db, $id_usuari) {
    $sql = "SELECT c.id_carrito, p.id_prod, p.nom, p.autor, p.img, p.preu, c.quantitat 
            FROM Carrito c
            INNER JOIN Producte p ON c.id_prod = p.id_prod
            WHERE c.id_usuari = $1";
    $result = pg_query_params($db, $sql, array($id_usuari)) or die("Error al obtener el carrito.");
    return pg_fetch_all($result);
}

function actualizarCantidadCarrito($db, $id_carrito, $quantitat) {
    $sql = "UPDATE Carrito SET Quantitat = $1 WHERE id_carrito = $2";
    $result = pg_query_params($db, $sql, array($quantitat, $id_carrito));
    return $result !== false;
}

function eliminarProductoCarrito($db, $id_carrito) {
    $sql = "DELETE FROM Carrito WHERE id_carrito = $1";
    $result = pg_query_params($db, $sql, array($id_carrito));
    return $result !== false;
}
function vaciarCarrito($db, $id_usuari) {
    $sql = "DELETE FROM Carrito WHERE id_usuari = $1";
    $result = pg_query_params($db, $sql, array($id_usuari));
    return $result !== false;
}
function guardarComanda($db, $id_usuari) {
    // Crear la comanda a la taula `comanda`
    $sql_comanda = "INSERT INTO comanda (id_usuari, fecha) VALUES ($1, NOW()) RETURNING id_comanda";
    $result_comanda = pg_query_params($db, $sql_comanda, array($id_usuari));

    if (!$result_comanda) {
        error_log("Error al crear la comanda: " . pg_last_error($db));
        return false;
    }

    $id_comanda = pg_fetch_result($result_comanda, 0, 'id_comanda');

    // Afegir els productes al detall de la comanda
    $productos = obtenerCarrito($db, $id_usuari);

    foreach ($productos as $producto) {
        $sql_linia_comanda = "INSERT INTO linia_comanda (id_prod, id_comanda, quantitat) 
                              VALUES ($1, $2, $3)";
        $result_linia_comanda = pg_query_params($db, $sql_linia_comanda, array(
            $producto['id_prod'],
            $id_comanda,
            $producto['quantitat']
        ));

        if (!$result_linia_comanda) {
            error_log("Error al inserir el detall de la comanda: " . pg_last_error($db));
            return false;
        }
    }
    return $id_comanda;
}


function obtenerPedido($db, $id_comanda) {
    $sql = "SELECT * FROM comanda WHERE id_comanda = $1";
    $result = pg_query_params($db, $sql, array($id_comanda));
    return pg_fetch_assoc($result);
}


function obtenerDetallePedido($db, $id_comanda) {
    $sql = "SELECT lc.id_prod, lc.quantitat, p.nom, p.preu, p.img, p.autor
            FROM linia_comanda lc
            INNER JOIN producte p ON lc.id_prod = p.id_prod
            WHERE lc.id_comanda = $1"; 
    $result = pg_query_params($db, $sql, array($id_comanda));
    return pg_fetch_all($result);
}

function obtenerPedidos($db, $id_usuari) {
    $sql = "SELECT id_comanda, TO_CHAR(fecha, 'DD-MM-YYYY') AS fecha
            FROM Comanda
            WHERE id_usuari = $1
            ORDER BY id_comanda DESC";
    $consulta = pg_query_params($db, $sql, array($id_usuari)) or die("Error al obtener los pedidos.");
    return pg_fetch_all($consulta);
}

function obtenerPedidosConProductos($db, $id_usuari) {
    $pedidos = obtenerPedidos($db, $id_usuari);

    if (!$pedidos) {
        return [];
    }

    foreach ($pedidos as &$pedido) {
        $pedido['productos'] = obtenerDetallePedido($db, $pedido['id_comanda']);
        $total = 0;
        foreach ($pedido['productos'] as $producto) {
            $total = $total + ($producto['quantitat'] * $producto['preu']);
        }
        $pedido['precio_total'] = $total;
    }

    return $pedidos;
}

function obtenerResumenCarrito($db, $id_usuari) {
    $sql = "SELECT 
                SUM(c.quantitat) AS numeroProductos, 
                SUM(c.quantitat * p.preu) AS precioTotal
            FROM Carrito c
            INNER JOIN Producte p ON c.id_prod = p.id_prod
            WHERE c.id_usuari = $1";
    $consulta = pg_query_params($db, $sql, array($id_usuari)) or die("Error al obtener el resumen del carrito.");
    $resultado = pg_fetch_assoc($consulta);

    return [
        'numeroProductos' => $resultado['numeroproductos'] ?? 0,
        'precioTotal' => $resultado['preciototal'] ?? 0,
    ];
}
?>