// editarPerfil.js

document.addEventListener("DOMContentLoaded", function () {
    const btnEditar = document.getElementById("btn-editar");
    const btnCancelar = document.getElementById("btn-cancelar");
    const perfilLectura = document.getElementById("perfil-lectura");
    const perfilEdicio = document.getElementById("perfil-edicio");

    // Quan es prem el botó "Editar", mostra el formulari d'edició
    btnEditar.addEventListener("click", function () {
        perfilLectura.style.display = "none";
        perfilEdicio.style.display = "block";
    });

    // Quan es prem el botó "Cancel·lar", torna a la vista inicial
    btnCancelar.addEventListener("click", function () {
        perfilLectura.style.display = "block";
        perfilEdicio.style.display = "none";
    });
});

function mostrarImatge(event) {
    var output = document.getElementById('imatge-perfil');
    var previsualitzacio = document.getElementById('imatge-previsualitzacio'); // Imatge de previsualització
    var reader = new FileReader();

    reader.onload = function() {
        output.src = reader.result; // Actualitza la imatge de perfil amb la nova imatge
        previsualitzacio.src = reader.result; // Mostra la imatge seleccionada com a previsualització
    }

    if (event.target.files[0]) {
        reader.readAsDataURL(event.target.files[0]); // Llegeix la imatge seleccionada i la mostra immediatament
    }
}
