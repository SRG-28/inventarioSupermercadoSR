<?php

class Producto
{
    private $archivo;

    public function __construct()
    {
        $this->archivo = 'data/productos.json';
    }

    private function leerDatos()
    {
        $datos = file_get_contents($this->archivo);
        return json_decode($datos, true);
    }

    private function guardarDatos($datos)
    {
        file_put_contents($this->archivo, json_encode($datos, JSON_PRETTY_PRINT));
    }

    public function getProductos()
    {
        return $this->leerDatos();
    }

    public function getProducto($id)
    {
        $productos = $this->leerDatos();
        foreach ($productos as $producto) {
            if ($producto['id'] == $id) {
                return $producto;
            }
        }
        return null;
    }

    public function crearProducto($nombre, $precio, $cantidad)
    {
        $productos = $this->leerDatos();
        $id = count($productos) > 0 ? max(array_column($productos, 'id')) + 1 : 1;
        $productos[] = ['id' => $id, 'nombre' => $nombre, 'precio' => $precio, 'cantidad' => $cantidad];
        $this->guardarDatos($productos);
    }

    public function actualizarProducto($id, $nombre, $precio, $cantidad)
    {
        $productos = $this->leerDatos();
        foreach ($productos as &$producto) {
            if ($producto['id'] == $id) {
                $producto['nombre'] = $nombre;
                $producto['precio'] = $precio;
                $producto['cantidad'] = $cantidad;
                $this->guardarDatos($productos);
                return;
            }
        }
    }

    public function eliminarProducto($id)
    {
        $productos = $this->leerDatos();
        $productos = array_filter($productos, function($producto) use ($id) {
            return $producto['id'] != $id;
        });
        $this->guardarDatos($productos);
    }
}
