<!--Titulo de la Página-->
<div class="Cabecera-Titulo"><a href="index.php">Fresh Comics</a></div>
<!--Opciones bajo titulo-->
<div class="ops-tit">
    <div class="nav-wrapper">
        <!-- Opciones de navegación a la izquierda -->
        <div class="ops-links">
            <a href="javascript:void(0);" onclick="llistaProductes(1)">Marvel</a>
            <a href="javascript:void(0);" onclick="llistaProductes(2)">DC</a>
        </div>
                
        <!-- Lupa de búsqueda en el centro -->
        <div class="search-container">
            <i class="fas fa-search search-icon" onclick="toggleSearchBar()"></i>
            <!-- Barra de búsqueda que se despliega al hacer clic -->
            <div class="search-bar" id="searchBar">
                <input type="text" id="searchInput" placeholder="Buscar...">
                <button onclick="buscarProductos()">Buscar</button>
            </div>
        </div>

        <!-- Opciones de navegación a la derecha del centro -->
        <div class="ops-links">
            <a href="javascript:void(0);" onclick="llistaProductes(3)">Manga</a>
            <a href="javascript:void(0);" onclick="llistaProductes(4)">Libros</a>
        </div>
        <!-- Contenedor del icono de inicio de sesión -->
        <div class="login-wrapper">
            <?php if (isset($_SESSION['img_usuari'])) : ?>
                <!-- Imagen de perfil o icono por defecto -->
                <img src="<?= 'https://tdiw-f7.deic-docencia.uab.cat/img/perfilUsuari/' . basename($_SESSION['img_usuari']) ?>" alt="Perfil" onclick="toggleUserMenu()" style="border-radius: 50%; width: 40px; height: 40px;">
            <?php else : ?>
                <!-- Icono por defecto si no hay sesión -->
                <i class="fas fa-user login-icon" onclick="toggleUserMenu()"></i>
            <?php endif; ?>
        </div>
        <div class="user-menu" id="userMenu">
            <ul>
                <?php if (isset($_SESSION['usuario'])) : ?>
                    <li><a href="index.php?accio=perfil_usuari">Mi Perfil</a></li>
                    <li><a href="index.php?accio=carrito">Mi Carrito</a></li>
                    <li><a href="index.php?accio=ver_pedidos">Mis Pedidos</a></li>
                    <li><a href="index.php?accio=cerrar_sesion">Cerrar Sesión</a></li>
                <?php else : ?>
                    <li><a href="javascript:void(0);" onclick="inicioSesion()">Iniciar Sesión</a></li>
                    <li><a href="javascript:void(0);" onclick="usuarioRegistro()">Registrarse</a></li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</div>