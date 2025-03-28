<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title>Editar Perfil</title>
    <link rel="stylesheet" type="text/css" href="/css/webcss3.css" title="main">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/css/estilMiPerfil.css">
    <link rel="stylesheet" href="/css/estilVistaProd.css">
</head>
<body>

<div class="Cabecera-Titulo"><a href="/../index.php">Fresh Comics</a></div>

<section>
    <!-- Vista inicial amb dades de l'usuari -->
    <div id="perfil-lectura" class="perfil-container">
        <!-- Mostrar imatge de perfil (ruta relativa) -->
        <img src="<?= !empty($usuari['img_perfil']) ? 'https://tdiw-f7.deic-docencia.uab.cat/img/perfilUsuari/' . basename($usuari['img_perfil']) : '/img/default-user.png' ?>" alt="Foto de perfil" id="imatge-perfil">
        <p><strong>Nom:</strong> <?= htmlspecialchars($usuari['nom'] ?? 'No disponible') ?></p>
        <p><strong>Adreça:</strong> <?= htmlspecialchars($usuari['adreça'] ?? 'No disponible') ?></p>
        <p><strong>Població:</strong> <?= htmlspecialchars($usuari['poblacio'] ?? 'No disponible') ?></p>
        <p><strong>Codi Postal:</strong> <?= htmlspecialchars($usuari['codi_postal'] ?? 'No disponible') ?></p>
        <button id="btn-editar" class="btn-editar">Editar</button>
    </div>

<!-- Formulari d'edició amb previsualització de la imatge -->
<div id="perfil-edicio" class="perfil-container" style="display: none;">
    <form action="/controladors/editar_usuari.php" method="post" enctype="multipart/form-data">
        
        <!-- Imatge de previsualització -->
        <img id="imatge-previsualitzacio" 
            src="<?= !empty($usuari['img_perfil']) ? 'https://tdiw-f7.deic-docencia.uab.cat/img/perfilUsuari/' . basename($usuari['img_perfil']) : '/img/default-user.png' ?>"
            alt="Previsualització" 
            style="max-width: 150px; margin-top: 10px; position: relative; z-index: 2;">

        <!-- Botó d'entrada arxiu ocult -->
        <label for="imatge" class="editar-label">Editar Foto</label>
        <input type="file" id="imatge" name="imatge" accept="image/*" onchange="mostrarImatge(event)" style="display: none;">
        
        <!-- Altres camps del formulari -->
        <input type="text" name="nom" placeholder="Nom" value="<?= htmlspecialchars($usuari['nom'] ?? '') ?>" class="formulari-input">
        <input type="text" name="adreça" placeholder="Adreça" value="<?= htmlspecialchars($usuari['adreça'] ?? '') ?>" class="formulari-input">
        <input type="text" name="poblacio" placeholder="Població" value="<?= htmlspecialchars($usuari['poblacio'] ?? '') ?>" class="formulari-input">
        <input type="text" name="codi_postal" placeholder="Codi Postal" value="<?= htmlspecialchars($usuari['codi_postal'] ?? '') ?>" class="formulari-input">
        <button type="submit" class="btn-guardar">Guardar</button>
    </form>
    <button id="btn-cancelar" class="btn-cancelar">Cancel·lar</button>
</div>

</section>

<script src="../js/editarPerfil.js"></script>
</body>
</html>