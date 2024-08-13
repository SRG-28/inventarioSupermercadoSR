<?php

require_once 'controllers/ProductoController.php';

$controller = new ProductoController();

$action = $_GET['action'] ?? 'index';

switch ($action) {
    case 'listar':
        $controller->index();
        break;
    case 'ver':
        $controller->ver($_GET['id']);
        break;
    case 'crear':
        $controller->crear();
        break;
    case 'actualizar':
        $controller->actualizar($_POST['id']);
        break;
    case 'eliminar':
        $controller->eliminar($_GET['id']);
        break;
    default:
        require 'views/productos.php';
        break;
}
