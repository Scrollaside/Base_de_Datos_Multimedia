const categorias = [
    {
        nombre: "Programación",
        descripcion: "Cursos relacionados con el desarrollo de software",
        admin: "Alfonso David Marcelo Ibarra Navarro",
        fecha: "15 sept 2024, 10:00"
    },
    {
        nombre: "Modelado",
        descripcion: "Técnica de crear una imagen digital tridimensional de un objeto mediante un software CAD.",
        admin: "Alfonso David Marcelo Ibarra Navarro",
        fecha: "15 sept 2024, 12:10"
    },
    {
        nombre: "Web",
        descripcion: "Red informática.",
        admin: "Alfonso David Marcelo Ibarra Navarro",
        fecha: "12 octu 2022, 14:45"
    },
    {
        nombre: "Dibujo",
        descripcion: "Forma de expresión artística que consiste en crear imágenes sobre una superficie plana mediante líneas, trazos y formas.",
        admin: "Alfonso David Marcelo Ibarra Navarro",
        fecha: "21 abri 2021, 21:01"
    },
    {
        nombre: "Marketing",
        descripcion: "Conjunto de técnicas, estrategias y procesos que una marca o empresa implementa de manera ética para crear, comunicar, intercambiar y entregar ofertas o mensajes que dan valor e interesan a clientes, audiencias, socios, proveedores y personas en general.",
        admin: "Alfonso David Marcelo Ibarra Navarro",
        fecha: "04 juni 2018, 11:11"
    }
];


let editando = false;
let indiceCategoriaEditar = -1;


document.addEventListener('DOMContentLoaded', function() {
    mostrarCategorias();
});


function agregarCategoria() {

    const nombre = document.getElementById('nombreCategoria').value.trim();
    const descripcion = document.getElementById('descripcionCategoria').value.trim();
    const adminName = document.getElementById('adminName').value;
    const fechaCreacion = new Date().toLocaleString('es-ES', { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' });


    if (nombre === "" || descripcion === "") {
        alert('Por favor, complete todos los campos');
        return;
    }


    if (editando) {
        categorias[indiceCategoriaEditar].nombre = nombre;
        categorias[indiceCategoriaEditar].descripcion = descripcion;
        alert('Categoría actualizada con éxito');
    } else {

        const existe = categorias.findIndex(c => c.nombre.toLowerCase() === nombre.toLowerCase());

        if (existe !== -1) {

            categorias[existe].descripcion = descripcion;
            categorias[existe].admin = adminName;
            categorias[existe].fecha = fechaCreacion;
            alert('Categoría actualizada con éxito');
        } else {

            categorias.push({
                nombre: nombre,
                descripcion: descripcion,
                admin: adminName,
                fecha: fechaCreacion
            });
            alert('Categoría agregada con éxito');
        }
    }


    resetForm();
    mostrarCategorias();
}


function mostrarCategorias() {
    const tabla = document.getElementById('tablaCategorias');
    tabla.innerHTML = '';

    categorias.forEach((categoria, index) => {

        const fila = `
            <tr>
                <td>${categoria.nombre}</td>
                <td>${categoria.descripcion}</td>
                <td>${categoria.admin}</td>
                <td>${categoria.fecha}</td>
                <td><button onclick="editarCategoria(${index})">Editar</button></td>
                <td><button onclick="eliminarCategoria(${index})">Eliminar</button></td>
            </tr>
        `;
        tabla.innerHTML += fila; 
    });
}


function editarCategoria(index) {
    const categoria = categorias[index];
    document.getElementById('nombreCategoria').value = categoria.nombre;
    document.getElementById('descripcionCategoria').value = categoria.descripcion;
    editando = true;
    indiceCategoriaEditar = index; 
}

// Función para eliminar una categoría
function eliminarCategoria(index) {
    categorias.splice(index, 1); 
    mostrarCategorias(); 
    resetForm(); 
}


function resetForm() {
    document.getElementById('nombreCategoria').value = ''; 
    document.getElementById('descripcionCategoria').value = ''; 
    editando = false; 
    indiceCategoriaEditar = -1; 
}
