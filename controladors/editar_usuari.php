<?php
session_start();
require_once __DIR__ . '/../models/usuari.php';
require_once __DIR__ . '/../models/conectaBD.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom = $_POST['nom'] ?? null;
    $adreça = $_POST['adreça'] ?? null;
    $poblacio = $_POST['poblacio'] ?? null;
    $codi_postal = $_POST['codi_postal'] ?? null;

    $emailAntic = $_SESSION['usuario'] ?? null;
    $db = conectaDB();

    $usuari = getUserByEmail($db, $emailAntic);
    $rutaImatge = $usuari['img_perfil'];

    if (isset($_FILES['imatge']) && $_FILES['imatge']['error'] == 0) {
        $tipusImatge = mime_content_type($_FILES['imatge']['tmp_name']);

        if (strpos($tipusImatge, 'image') === false) {
            exit;
        }

        $nomImatge = uniqid('perfil_', true) . '.' . pathinfo($_FILES['imatge']['name'], PATHINFO_EXTENSION);
        $rutaImatge = '/home/TDIW/tdiw-f7/public_html/img/perfilUsuari/' . $nomImatge;
        $_SESSION['img_usuari'] = $rutaImatge;

        if (file_exists($_FILES['imatge']['tmp_name'])) {
        }

        if (move_uploaded_file($_FILES['imatge']['tmp_name'], $rutaImatge)) {
        } else {
            exit;
        }
    }

    $resultat = editarUsuari($db, $nom, $adreça, $poblacio, $codi_postal, $emailAntic, $rutaImatge);

    if ($resultat) {
        header("Location: /../index.php");
        exit;
    } else {
        echo "Error en l'edició de l'usuari. Revisa les dades.<br>";
    }
}
?>
