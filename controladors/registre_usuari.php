<?php
session_start();
require_once __DIR__ . '/../models/usuari.php';
require_once __DIR__ . '/../models/conectaBD.php';

// Comprovem si les dades han estat enviades pel formulari
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Recollim les dades del formulari
    $nom = $_POST['nom'] ?? null;
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;
    $adreça = $_POST['adreça'] ?? null;
    $poblacio = $_POST['poblacio'] ?? null;
    $codi_postal = $_POST['codi_postal'] ?? null; 

    $errors = [];

    // Validació: camps no poden estar buits
    if (empty($nom)) $errors[] = "El nom és obligatori.";
    if (empty($email)) $errors[] = "El correu electrònic és obligatori.";
    if (empty($password)) $errors[] = "La contrasenya és obligatòria.";
    if (empty($adreça)) $errors[] = "L'adreça és obligatòria.";
    if (empty($poblacio)) $errors[] = "La població és obligatòria.";
    if (empty($codi_postal)) $errors[] = "El codi postal és obligatori.";

    // Validació: format de correu electrònic
    if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "El correu electrònic no té un format vàlid.";
    }

    // Validació: codi postal ha de ser un enter
    if (!empty($codi_postal) && !ctype_digit($codi_postal)) {
        $errors[] = "El codi postal ha de ser un número enter.";
    }

    // Si hi ha errors, tornem a la pàgina de registre
    if (!empty($errors)) {
        $_SESSION['errors'] = $errors;
        header("Location: /../index.php?accio=registre_usuari");
        exit;
    }

    // Xifrem la contrasenya
    $passwordEncriptada = password_hash($password, PASSWORD_BCRYPT);

    $db = conectaDB();

    // Guardem les dades de l'usuari a la base de dades
    $registreExit = crearUsuari($db, $nom, $email, $passwordEncriptada, $adreça, $poblacio, $codi_postal);

    if ($registreExit) {
        $_SESSION['usuario'] = $email;
        $_SESSION['nom'] = $nom;
        $user = getUserByEmail($db, $email);
        $_SESSION['id_usuari'] = $user['id_usuari'];
        // Redirigim l'usuari a la pàgina principal
        header("Location: /../index.php");
        exit;
    } else {
        echo "Error al crear l'usuari. Revisa les dades.";
    }
}

include __DIR__ . '/../index.php';
?>

