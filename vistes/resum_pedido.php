<!DOCTYPE html>
<html lang="es">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=utf-8">
    <title>Resumen del Pedido</title>
    <link rel="stylesheet" type="text/css" href="/css/webcss3.css" title="main">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/css/estilMiPerfil.css">
    <link rel="stylesheet" href="/css/estilVistaProd.css">
    <link rel="stylesheet" href="/css/resumenPedido.css">
</head>
<body>
    <!-- Cabecera -->
    <div class="Cabecera-Titulo">
        <a href="/../index.php">Fresh Comics</a>
    </div>

    <div class="resumen-container">
        <h1 class="resumen-title">¡Pedido realizado correctamente!</h1>
        <p class="resumen-subtitle">A continuación, se muestra un resumen de tu pedido:</p>
        
        <?php if ($productos): ?>
            <?php foreach ($productos as $producto): ?>
                <div class="pedido-item">
                    <img src="<?php echo htmlspecialchars($producto['img']); ?>" alt="Imagen del producto" class="pedido-item-img">
                    <div class="pedido-item-details">
                        <h2 class="pedido-item-title">
                            <?php echo htmlspecialchars($producto['nom']); ?> x <?php echo htmlspecialchars($producto['quantitat']); ?>
                        </h2>
                        <p class="pedido-item-author"><?php echo htmlspecialchars($producto['autor']); ?></p>
                    </div>
                </div>
                <hr>
            <?php endforeach; ?>
            <div class="seguir-comprando">
                <a href="index.php" class="seguir-comprando-button">Seguir Comprando</a>
            </div>
        <?php else: ?>
            <div class="empty-pedido-message">
                <p>No se encontraron productos en este pedido.</p>
            </div>
        <?php endif; ?>
    </div>

    <?php require __DIR__.'/../controladors/footer_pagina.php'; ?>
</body>
</html>
