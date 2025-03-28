<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="css/estilFormulari.css">
</head>
<body>
    <div class="formulari-registre">
        <h2>Iniciar Sesión</h2>
        <!-- Enviem la informació de l'usuari al controlador-->
        <form action="/../controladors/inici_sesio.php" method="post">
            <label for="email">Correu electrònic:</label>
            <input type="email" id="email" name="email" required>
            <br><br>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required pattern="[A-Za-z0-9]+">
            <br><br>

            <button type="submit">Iniciar Sesión</button>
        </form>
    </div>
</body>
</html>
