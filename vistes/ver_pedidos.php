<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FRESH COMICS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/css/estilVistaProd.css">
    <link rel="stylesheet" href="/css/dataPaginaInicial.css">
    <link rel="stylesheet" href="css/carrito.css">
    <link rel="stylesheet" href="css/ver_pedidos.css">
    <link rel="stylesheet" href="/css/resumen_carrito.css">
    <script src="js/vistaProd.js"></script>
    <script src="js/fetch.js"></script>
    <script src="js/carrito.js"></script>
</head>
<body>
    <header>
        <?php require __DIR__.'/../controladors/cabecera_pagina.php'; ?>
    </header>
    <section id = bloquePrincipal>
        <div class="pedidos-container">
            <h1 id="titulo_mis_pedidos">Mis Pedidos</h1>
            <?php if ($pedidos): ?>
                <?php foreach ($pedidos as $pedido): ?>
                    <div class="pedido">
                        <h2 class="pedido-title">Pedido #<?php echo htmlspecialchars($pedido['id_comanda']); ?></h2>
                        <p class="pedido-date">Realizado el: <?php echo htmlspecialchars($pedido['fecha']); ?></p>
                        <div class="pedido-productos">
                            <?php foreach ($pedido['productos'] as $producto): ?>
                                <div class="pedido-item">
                                    <img src="<?php echo htmlspecialchars($producto['img']); ?>" alt="Imagen del producto" class="pedido-item-img">
                                    <div class="pedido-item-details">
                                        <h3 class="pedido-item-title">
                                            <?php echo htmlspecialchars($producto['nom']); ?> x <?php echo htmlspecialchars($producto['quantitat']); ?>
                                        </h3>
                                        <p class="pedido-item-author"><?php echo htmlspecialchars($producto['autor']); ?></p>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <p class="pedido-total">Total del Pedido: <?php echo htmlspecialchars(number_format($pedido['precio_total'], 2)); ?> €</p> 
                    </div>
                    <hr>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-pedidos-message">
                    <p>No has realizado ningún pedido.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php require __DIR__.'/../controladors/footer_pagina.php'; ?>
</body>
</html>