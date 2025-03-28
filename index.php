<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

$accio = $_GET['accio'] ?? NULL;

switch ($accio) {
	case 'vista_producto':
		include __DIR__ . '/recursos/recurs_producto.php';
		break;
	case 'registre_usuari':
		include __DIR__ . '/recursos/recurs_registre_usuari.php';
		break;
	case 'perfil_usuari':
		include __DIR__ . '/recursos/recurs_mi_perfil.php';
		break;	
	case 'llistar_productes':
		include __DIR__ . '/recursos/recurs_llistar_productes.php';
		break;
	case 'buscar_productos':
		include __DIR__ . '/recursos/recurs_buscar_productes.php';
		break;
	case 'pagina_logs':
		include __DIR__ . '/recursos/recurs_pagina_inicio.php';
		break;
	case 'login':
		include __DIR__ . '/recursos/recurs_inici_sesio.php';
		break;
	case 'agregar_carrito':
		include __DIR__ . '/recursos/recurs_agregar_carrito.php';
		break;
	case 'carrito':
		include __DIR__ . '/recursos/recurs_ver_carrito.php';
		break;
	case 'actualizar_carrito':
		include __DIR__ . '/recursos/recurs_actualizar_carrito.php';
		break;
	case 'eliminar_carrito':
		include __DIR__ . '/recursos/recurs_eliminar_carrito.php';
		break;
	case 'vaciar_carrito':
		include __DIR__ . '/recursos/recurs_vaciar_carrito.php';
		break;
	case 'realizar_pedido':
		include __DIR__ . '/recursos/recurs_realizar_pedido.php';
		break;
	case 'resum_pedido':
		include __DIR__ . '/recursos/recurs_resum_pedido.php';
		break;
	case 'ver_pedidos':
		include __DIR__ . '/recursos/recurs_ver_pedidos.php';
		break;
	case 'obtener_resumen_carrito':
		include __DIR__ . '/recursos/recurs_resumen_carrito.php';
		break;
	case 'cerrar_sesion':
		session_unset();
		session_destroy();
		header("Location: /../index.php");
        exit;
		break;
	default:
		include __DIR__ . '/recursos/recurs_mostra_categories.php';
		break;
}

?>