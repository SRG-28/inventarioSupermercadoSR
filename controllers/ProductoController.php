<?php

require_once 'models/Producto.php';

class ProductoController
{
    private $productoModel;

    public function __construct()
    {
        $this->productoModel = new Producto();
    }

    public function index()
    {
        $productos = $this->productoModel->getProductos();
        header('Content-Type: application/json');
        echo json_encode($productos);
    }

    public function ver($id)
    {
        $producto = $this->productoModel->getProducto($id);
        header('Content-Type: application/json');
        echo json_encode($producto);
    }

    public function crear()
    {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $this->productoModel->crearProducto($nombre, $precio, $cantidad);
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    }

    public function actualizar($id)
    {
        $nombre = $_POST['nombre'];
        $precio = $_POST['precio'];
        $cantidad = $_POST['cantidad'];
        $this->productoModel->actualizarProducto($id, $nombre, $precio, $cantidad);
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    }

    public function eliminar($id)
    {
        $this->productoModel->eliminarProducto($id);
        header('Content-Type: application/json');
        echo json_encode(['success' => true]);
    }
}
