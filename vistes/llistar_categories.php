<?php foreach ($categories_with_products as $category): ?>
    <div class="espai-seccio" id="<?php echo htmlspecialchars($category['nom']); ?>">
        <div class="franja-roja-baix">
            <span><strong><?php echo htmlspecialchars($category['nom']); ?></strong></span>
            <a href="javascript:void(0);" onclick="llistaProductes(<?php echo $category['id_categoria'];?>)" class="sin-estilo"> 
                <span><strong>VER MÁS ></strong></span>
            </a>
        </div>

        <div class="placeholders-section">
            <div class="placeholders-container">
                <?php if ($category['producte']): ?>
                    <?php foreach ($category['producte'] as $producto): ?>
                        
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
                    <p>No hay productos disponibles en esta categoría.</p>
                <?php endif; ?>
            </div>
            <hr/>
        </div>
    </div>
<?php endforeach; ?>

<?php if (isset($_SESSION['usuario'])) : ?>
    <div id="resumen-carrito" class="resumen-carrito">
        <span>Resumen del Carrito:</span>
        <span id="numero-productos">Número de Productos: 0</span>
        <span id="precio-total">Precio Total: 0€</span>
        <a href="index.php?accio=carrito" class="ver-carrito">Ver completo</a>
    </div>
<?php endif; ?>