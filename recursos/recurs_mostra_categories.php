<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FRESH COMICS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/css/estilVistaProd.css">
    <link rel="stylesheet" href="/css/dataPaginaInicial.css">
    <link rel="stylesheet" href="/css/resumen_carrito.css">
    <script src="js/vistaProd.js"></script>
    <script src="js/fetch.js"></script>
    <script src="js/carrito.js"></script>
</head>
<body>
    <header>
        <?php require __DIR__.'/../controladors/cabecera_pagina.php'; ?>
    </header>
    <section id="bloquePrincipal">
        <div class="container">
            <?php require __DIR__.'/../controladors/llistar_categories.php'; ?>
        </div>
    </section>
    <?php require __DIR__.'/../controladors/footer_pagina.php'; ?>
</body>
</html>
