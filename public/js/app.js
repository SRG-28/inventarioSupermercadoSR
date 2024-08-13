new Vue({
    el: '#app',
    data: {
        productos: [],
        formularioVisible: false,
        formularioData: {
            id: null,
            nombre: '',
            precio: 0,
            cantidad: 0
        }
    },
    mounted() {
        this.cargarProductos();
    },
    methods: {
        async cargarProductos() {
            const response = await fetch('index.php?action=listar');
            this.productos = await response.json();
        },
        async mostrarFormulario(producto) {
            if (producto) {
                this.formularioData = { ...producto };
            } else {
                this.formularioData = { id: null, nombre: '', precio: 0, cantidad: 0 };
            }
            this.formularioVisible = true;
        },
        ocultarFormulario() {
            this.formularioVisible = false;
        },
        async guardarProducto() {
            const url = this.formularioData.id ? 'index.php?action=actualizar' : 'index.php?action=crear';
            await fetch(url, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: new URLSearchParams(this.formularioData)
            });
            this.cargarProductos();
            this.ocultarFormulario();
        },
        async eliminarProducto(id) {
            await fetch('index.php?action=eliminar&id=' + id, {
                method: 'POST'
            });
            this.cargarProductos();
        }
    }
});

