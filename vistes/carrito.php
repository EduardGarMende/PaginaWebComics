<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>FRESH COMICS</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="/css/estilVistaProd.css">
    <link rel="stylesheet" href="/css/dataPaginaInicial.css">
    <link rel="stylesheet" href="css/carrito.css">
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
        <h1>Mi Carrito</h1>
        <div class="carrito-container">
            <?php if ($productosCarrito): ?>
                <?php $precioTotal = 0; ?>
                <?php foreach ($productosCarrito as $producto): ?>
                    <?php $precioTotal += $producto['preu'] * $producto['quantitat']; ?>
                    <div class="carrito-item">
                        <img src="<?php echo htmlspecialchars($producto['img']); ?>" alt="Imagen del producto" class="carrito-item-img">
                        <div class="carrito-item-details">
                            <h2 class="carrito-item-title"><?php echo htmlspecialchars($producto['nom']); ?></h2>
                            <p class="carrito-item-author"><?php echo htmlspecialchars($producto['autor']); ?></p>
                            <div class="carrito-item-bottom">
                                <span class="carrito-item-price">€<?php echo number_format($producto['preu'], 2, ',', '.'); ?></span>
                                <input type="number" class="carrito-item-quantity" 
                                    value="<?php echo $producto['quantitat']; ?>" 
                                    min="1" onchange="actualizarCantidad(<?php echo $producto['id_carrito']; ?>, this.value)">
                            </div>
                        </div>
                        <button class="carrito-item-remove" onclick="eliminarProducto(<?php echo $producto['id_carrito']; ?>)">✖</button>
                    </div>
                    <hr>
                <?php endforeach; ?>
                <div class="carrito-total">
                    <h2>Total: €<?php echo number_format($precioTotal, 2, ',', '.'); ?></h2>
                    <button class="carrito-vaciar" onclick="vaciarCarrito()">Vaciar Carrito</button>
                    <button class="carrito-comprar" onclick="realizarPedido()">Realizar Compra</button>
                </div>
            <?php else: ?>
                <div class="empty-cart-message">
                    <p>No tienes productos en tu carrito.</p>
                </div>
            <?php endif; ?>
        </div>
    </section>
    <?php require __DIR__.'/../controladors/footer_pagina.php'; ?>
</body>
</html>