async function llistaProductes(idCategoria) {
    var resposta = await fetch("index.php?accio=llistar_productes&id_categoria=" + idCategoria);
    var respostaText = await resposta.text();
    document.getElementById("bloquePrincipal").innerHTML = respostaText;
    window.scrollTo({
        top: 0,           // Posición en la que se desplazará (0px desde la parte superior)
        behavior: "smooth" // Desplazamiento suave
    });
    actualizarResumenCarrito();
}

async function producte(idProd) {
    var resposta = await fetch("index.php?accio=vista_producto&id=" + idProd);
    var respostaText = await resposta.text();
    document.getElementById("bloquePrincipal").innerHTML = respostaText;
    window.scrollTo({
        top: 0,           // Posición en la que se desplazará (0px desde la parte superior)
        behavior: "smooth" // Desplazamiento suave
    });
    actualizarResumenCarrito();
}

async function buscarProductos() {
    var query = document.getElementById("searchInput").value;

    if (!query.trim()) {
        alert("Por favor, ingresa un producto ha buscar.");
        return;
    }

    try {
        var resposta = await fetch("index.php?accio=buscar_productos&query=" + encodeURIComponent(query));
        var respostaText = await resposta.text();
        document.getElementById("bloquePrincipal").innerHTML = respostaText;
        window.scrollTo({
            top: 0,           // Posición en la que se desplazará (0px desde la parte superior)
            behavior: "smooth" // Desplazamiento suave
        });
        actualizarResumenCarrito();
    } catch (error) {
        console.error("Error al buscar productos:", error);
    }
}

async function usuarioRegistro() {
    var resposta = await fetch("index.php?accio=registre_usuari");
    var respostaText = await resposta.text();
    document.documentElement.innerHTML = respostaText;
    window.scrollTo({
        top: 0,           // Posición en la que se desplazará (0px desde la parte superior)
        behavior: "smooth" // Desplazamiento suave
    });
}

async function inicioSesion() {
    var resposta = await fetch("index.php?accio=login");
    var respostaText = await resposta.text();
    document.documentElement.innerHTML = respostaText;
    window.scrollTo({
        top: 0,           // Posición en la que se desplazará (0px desde la parte superior)
        behavior: "smooth" // Desplazamiento suave
    });
}

async function usuarioEditar() {
    var resposta = await fetch("index.php?accio=editar_usuari");
    var respostaText = await resposta.text();
    document.documentElement.innerHTML = respostaText;
    window.scrollTo({
        top: 0,
        behavior: "smooth"
    });
}

async function agregarAlCarrito(id_prod) {
    const cantidad = document.getElementById(`quantity-${id_prod}`).value;

    if (cantidad <= 0) {
        alert("Por favor, selecciona una cantidad válida.");
        return;
    }

    try {
        const respuesta = await fetch('index.php?accio=agregar_carrito', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id_prod, quantitat: cantidad })
        });

        const texto = await respuesta.text(); // Leer respuesta como texto
        console.log("Respuesta del servidor:", texto);

        const resultado = JSON.parse(texto); // Intentar parsear como JSON
        if (resultado.status === 'success') {
            actualizarResumenCarrito();
            alert('Producto añadido al carrito.');
        } else {
            alert('Error: ' + resultado.message);
        }
    } catch (error) {
        console.error('Error al agregar al carrito:', error);
    }
}