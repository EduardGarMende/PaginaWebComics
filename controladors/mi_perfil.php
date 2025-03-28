<?php
require_once __DIR__ . '/../models/usuari.php';
require_once __DIR__ . '/../models/conectaBD.php';

if (isset($_SESSION['usuario'])) {
    $email = $_SESSION['usuario'];
    $db = conectaDB();

    $usuari = getUserByEmail($db, $email);

    if (!$usuari) {
        echo "Error: No s'han trobat dades per a l'email proporcionat.";
        exit;
    }
} else {
    echo "Error: No s'ha iniciat sessió.";
    exit;
}

include __DIR__ . '/../vistes/mi_perfil.php';
?>