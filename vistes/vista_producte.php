<div class="container2">
    <!-- Imagen del producto -->
    <div class="product-image">
        <img src="<?php echo htmlspecialchars($product['img']); ?>" alt="<?php echo htmlspecialchars($product['nom']); ?>">
    </div>

    <!-- Detalles del producto -->
    <div class="product-details">
        <h1 class="product-title"><?php echo htmlspecialchars($product['nom']); ?></h1>
        <p class="product-author"><?php echo htmlspecialchars($product['autor']); ?></p>
        <p class="product-short-description"><?php echo htmlspecialchars($product['descripcio_corta']); ?></p>
        <p class="product-price">Precio: €<?php echo number_format($product['preu'], 2, ',', '.'); ?></p>
        <span class="availability <?php echo $product['actiu'] === 't' ? 'available' : 'unavailable'; ?>">
            <?php echo $product['actiu'] === 't' ? 'Disponible' : 'No disponible'; ?>
        </span>
        <div class="add-to-cart-container">
            <label for="quantity-<?php echo $product['id_prod']; ?>" class="quantity-label">Cantidad:</label>
            <input type="number" id="quantity-<?php echo $product['id_prod']; ?>" class="quantity-input" min="1" value="1">
            <button class="add-to-cart-button" onclick="<?php echo isset($_SESSION['usuario']) 
                ? "agregarAlCarrito({$product['id_prod']})" 
                : "mostrarAvisoSesion()"; ?>">Añadir a la cesta
            </button>
        </div>
    </div>
</div>

<!-- Separador y sección de descripción detallada -->
<div class="description-section">
    <div class="description-header">Descripción</div>
    
    <div class="extended-description">
        <!-- Descripción extendida a la izquierda -->
        <div class="description-text">
            <p><?php echo htmlspecialchars($product['descripcio']); ?></p>
        </div>

        <!-- Datos técnicos del libro a la derecha -->
        <div class="book-details">
            <ul>
                <li><span>ISBN:</span> <?php echo htmlspecialchars($product['isbn']); ?></li>
                <li><span>Tapa:</span> <?php echo $product['tapa'] === 't' ? 'Dura' : 'Blanda'; ?></li>
                <li><span>Fecha de Edición:</span> <?php echo htmlspecialchars($product['data_edicio']); ?></li>
                <li><span>Autor:</span> <?php echo htmlspecialchars($product['autor']); ?></li>
                <li><span>Número de Páginas:</span> <?php echo htmlspecialchars($product['n_pagines']); ?></li>
                <li><span>Peso:</span> <?php echo htmlspecialchars($product['peso']); ?>g</li>
            </ul>
        </div>
    </div>
</div>

<?php if (isset($_SESSION['usuario'])) : ?>
    <div id="resumen-carrito" class="resumen-carrito">
        <span>Resumen del Carrito:</span>
        <span id="numero-productos">Número de Productos: 0</span>
        <span id="precio-total">Precio Total: 0€</span>
        <a href="index.php?accio=carrito" class="ver-carrito">Ver completo</a>
    </div>
<?php endif; ?>