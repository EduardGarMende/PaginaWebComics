<?php
session_start();
require_once __DIR__ . '/../models/conectaBD.php';
require_once __DIR__ . '/../models/usuari.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    if (!$email || !$password) {
        die('Correu electrònic o contrasenya no especificats.');
    }

    $db = conectaDB();

    $user = getUserByEmail($db, $email);

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['usuario'] = $user['email'];
        $_SESSION['nom'] = $user['nom'];
        $_SESSION['id_usuari'] = $user['id_usuari'];
        if ($user['img_perfil']) {
            $_SESSION['img_usuari'] = $user['img_perfil'];
        }

        header('Location: /../index.php');
        exit;
    } else {
        echo 'Correu electrònic o contrasenya incorrectes.';
    }
}

include __DIR__ . '/../index.php';
?>