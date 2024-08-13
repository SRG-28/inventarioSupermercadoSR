<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventario de Productos</title>
    <link rel="stylesheet" href="public/css/styles.css">
</head>
<body>
    <div id="app">
        <h1>Lista de Productos</h1>
        <button @click="mostrarFormulario(null)">Agregar Producto</button>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Precio $</th>
                    <th>Cantidad</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="producto in productos" :key="producto.id">
                    <td>{{ producto.id }}</td>
                    <td>{{ producto.nombre }}</td>
                    <td>{{ producto.precio }}</td>
                    <td>{{ producto.cantidad }}</td>
                    <td>
                        <button @click="mostrarFormulario(producto)">Editar</button>
                        <button @click="eliminarProducto(producto.id)">Eliminar</button>
                    </td>
                </tr>
            </tbody>
        </table>
        <div v-if="formularioVisible">
            <h2>{{ formularioData.id ? 'Editar Producto' : 'Agregar Producto' }}</h2>
            <form @submit.prevent="guardarProducto">
                <p>Nombre</p><input type="text" v-model="formularioData.nombre" placeholder="Nombre" required>
                <p>Precio $</p><input type="number" v-model.number="formularioData.precio" placeholder="Precio" required>
                <p>Cantidad</p><input type="number" v-model.number="formularioData.cantidad" placeholder="Cantidad" required><br><br>
                <button type="submit">Guardar</button>
                <button @click="ocultarFormulario">Cancelar</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>
    <script src="public/js/app.js"></script>
</body>
</html>
