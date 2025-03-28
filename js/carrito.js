async function actualizarCantidad(id_carrito, nuevaCantidad) {
    if (nuevaCantidad < 1) {
        alert("La cantidad debe ser al menos 1.");
        return;
    }

    try {
        const respuesta = await fetch('index.php?accio=actualizar_carrito', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id_carrito, quantitat: nuevaCantidad }),
        });

        const resultado = await respuesta.json();
        if (resultado.status === 'success') {
            location.reload(); // Recarga la página para reflejar los cambios
        } else {
            alert("Error al actualizar la cantidad: " + resultado.message);
        }
    } catch (error) {
        console.error("Error al actualizar la cantidad:", error);
        alert("Hubo un error al procesar la solicitud.");
    }
}

async function eliminarProducto(id_carrito) {
    try {
        const respuesta = await fetch('index.php?accio=eliminar_carrito', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id_carrito }),
        });

        const texto = await respuesta.text(); // Leer como texto
        console.log("Respuesta del servidor:", texto);

        // Extraer solo el JSON válido usando una expresión regular
        const jsonMatch = texto.match(/({.*})/);
        if (!jsonMatch) {
            throw new Error(`Respuesta no válida: ${texto}`);
        }

        const resultado = JSON.parse(jsonMatch[1]); // Parsear el JSON válido
        if (resultado.status === 'success') {
            location.reload(); // Recarga la página para reflejar los cambios
        } else {
            alert("Error: " + resultado.message);
        }
    } catch (error) {
        console.error("Error al procesar la solicitud:", error);
        alert("Hubo un error al procesar la solicitud.");
    }
}

async function vaciarCarrito() {
    if (!confirm("¿Estás seguro de que deseas vaciar el carrito?")) {
        return;
    }

    try {
        const respuesta = await fetch('index.php?accio=vaciar_carrito', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
        });

        const resultado = await respuesta.json();
        if (resultado.status === 'success') {
            location.reload(); // Recarga la página para reflejar los cambios
        } else {
            alert("Error al vaciar el carrito: " + resultado.message);
        }
    } catch (error) {
        console.error("Error al vaciar el carrito:", error);
        alert("Hubo un error al procesar la solicitud.");
    }
}

async function realizarPedido() {
    try {
        const respuesta = await fetch('index.php?accio=realizar_pedido', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
        });
    
        console.log('Resposta HTTP:', respuesta);
    
        const text = await respuesta.text();
        console.log('Resposta en text:', text);
    
        const resultado = JSON.parse(text);
    
        if (resultado.status === 'success') {
            window.location.href = 'index.php?accio=resum_pedido&id_pedido=' + resultado.id_pedido;
        } else {
            alert("Error al realizar el pedido: " + resultado.message);
        }
    } catch (error) {
        console.error("Error al realizar el pedido:", error);
        alert("Hubo un error al procesar el pedido.");
    }
    
}

async function actualizarResumenCarrito() {
    try {
        const respuesta = await fetch('index.php?accio=obtener_resumen_carrito', {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        });

        const resultado = await respuesta.json();
        if (resultado.status === 'success') {
            document.getElementById('numero-productos').innerText = `Número de Productos: ${resultado.numeroProductos}`;
            document.getElementById('precio-total').innerText = `Precio Total: ${resultado.precioTotal}€`;
        } else {
            console.error('Error al obtener el resumen del carrito:', resultado.message);
        }
    } catch (error) {
        console.error('Error al procesar la solicitud:', error);
    }
}

// Actualizar el resumen del carrito al cargar la página
document.addEventListener('DOMContentLoaded', actualizarResumenCarrito);

// Actualizar periódicamente (cada 10 segundos) para reflejar cambios en el carrito
setInterval(actualizarResumenCarrito, 10000);