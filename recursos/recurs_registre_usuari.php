<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Formulari de Registre</title>
    <link rel="stylesheet" href="css/estilFormulari.css">
</head>
<body>
    <div class="formulari-registre">
        <h2>Formulari de Registre</h2>
        <?php if (!empty($_SESSION['errors'])): ?>
            <div class="error-messages">
                <?php foreach ($_SESSION['errors'] as $error): ?>
                    <p><?= htmlspecialchars($error) ?></p>
                <?php endforeach; ?>
                <?php unset($_SESSION['errors']); ?>
            </div>
        <?php endif; ?>
        <!-- Enviem la informació de l'usuari al controlador-->
        <form action="/../controladors/registre_usuari.php" method="post">
            <label for="nom">Nom:</label>
            <input type="text" id="nom" name="nom" required pattern="[A-Za-zÀ-ÿ\s]+">
            <br><br>

            <label for="email">Correu electrònic:</label>
            <input type="email" id="email" name="email" required>
            <br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required pattern="[A-Za-z0-9]+">
            <br><br>

            <label for="adreça">Adreça:</label>
            <input type="text" id="adreça" name="adreça" maxlength="30">
            <br><br>

            <label for="poblacio">Població:</label>
            <input type="text" id="poblacio" name="poblacio" maxlength="30">
            <br><br>

            <label for="codi_postal">Codi Postal:</label>
            <input type="text" id="codi_postal" name="codi_postal" required pattern="^\d{5}$">
            <br><br>

            <button type="submit">Registrar-se</button>
        </form>
    </div>
</body>
</html>
