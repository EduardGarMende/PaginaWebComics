function toggleSearchBar() {
    var searchBar = document.getElementById('searchBar');
    if (searchBar.style.display === 'none' || searchBar.style.display === '') {
        searchBar.style.display = 'block';  // Muestra la barra de búsqueda
    } else {
        searchBar.style.display = 'none';   // Oculta la barra de búsqueda
    }
}

function toggleUserMenu() {
    var userMenu = document.getElementById('userMenu');
    if (userMenu.style.display === 'none' || userMenu.style.display === '') {
        userMenu.style.display = 'block';  // Mostra el menú
    } else {
        userMenu.style.display = 'none';   // Amaga el menú
    }
}

function mostrarAvisoSesion() {
    alert("Por favor, inicia sesión o regístrate para añadir productos a la cesta.");
}