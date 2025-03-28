<div class="placeholders-section">
    <div class="placeholders-container">
        <?php if ($product): ?>
            <?php foreach ($product as $producto): ?>
                <a href="javascript:void(0);" onclick="producte(<?php echo $producto['id_prod'];?>)" class="product-link">
                <div class="placeholder">
                    <img src="<?php echo htmlspecialchars($producto['img']); ?>" alt="<?php echo htmlspecialchars($producto['nom']); ?>">
                    <p><?php echo htmlspecialchars($producto['nom']); ?></p>
                    <!-- Precio formateado como moneda -->
                    <p style="color: #ff4500; font-weight: bold; font-size: 1.2em;">
                        <?php echo '€' . number_format($producto['preu'], 2, ',', '.'); ?>
                    </p>
                </div>
                </a>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No hay productos encontrados.</p>
        <?php endif; ?>
    </div>
    <hr/>
</div>

<?php if (isset($_SESSION['usuario'])) : ?>
    <div id="resumen-carrito" class="resumen-carrito">
        <span>Resumen del Carrito:</span>
        <span id="numero-productos">Número de Productos: 0</span>
        <span id="precio-total">Precio Total: 0€</span>
        <a href="index.php?accio=carrito" class="ver-carrito">Ver completo</a>
    </div>
<?php endif; ?>