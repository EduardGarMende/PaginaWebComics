<?php
require_once __DIR__ . '/../models/carrito.php';
require_once __DIR__ . '/../models/conectaBD.php';


if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_GET['accio']) && $_GET['accio'] === 'realizar_pedido') {

    if (!isset($_SESSION['id_usuari'])) {
        echo json_encode(["status" => "error", "message" => "Debes iniciar sesión para ver tu carrito."]);
        exit;
    }

    $id_usuari = $_SESSION['id_usuari'];
    $db = conectaDB();
    // Crear la comanda
    $id_pedido = guardarComanda($db, $id_usuari);

    if ($id_pedido) {
        // Buidar el carret
        $carretBuidat = vaciarCarrito($db, $id_usuari);

        if (!$carretBuidat) {
            echo json_encode(["status" => "error", "message" => "No se pudo vaciar el carrito después de realizar el pedido."]);
            exit;
        }

        echo json_encode(["status" => "success", "message" => "Pedido realizado correctamente.", "id_pedido" => $id_pedido]);
    } else {
        echo json_encode(["status" => "error", "message" => "No se pudo guardar el pedido."]);
    }

    exit;
}

echo json_encode(["status" => "error", "message" => "Solicitud no válida."]);
exit;
?>
