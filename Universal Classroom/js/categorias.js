

class Categorie {
    constructor(nombre, descripcion, creador, creacion) {
        this.Nombre = nombre;
        this.Descripcion = descripcion;
        this.Creador = creador;
        this.Creacion = creacion;
        // this.ID = id;
    }

    get catelist() {
        let row = document.createElement("tr");
        row.setAttribute("data-nombre", this.Nombre); 
        row.innerHTML = `
            <td>${this.Nombre}</td>
            <td>${this.Descripcion}</td>
            <td>${this.Creador}</td>
            <td>${this.Creacion}</td>
            <td><button onclick="editarCategoria('${this.Nombre}', '${this.Descripcion}', '${this.Creador}')">Editar</button></td>
            <td><button onclick="eliminarCategoria()">Eliminar</button></td>
        `;
        return row;
    }
}

let editando = false;


document.addEventListener('DOMContentLoaded', function () {
    mostrarCategorias();
});


function guardarCategoria() {

    const nombre = document.getElementById('nombreCategoria').value.trim();
    const descripcion = document.getElementById('descripcionCategoria').value.trim();
    //const adminName = document.getElementById('adminName').value;
    //const fechaCreacion = new Date().toLocaleString('es-ES', { day: '2-digit', month: 'short', year: 'numeric', hour: '2-digit', minute: '2-digit' });


    if (nombre === "" || descripcion === "") {
        alert('Por favor, complete todos los campos');
        return;
    }

    const formData = new FormData();
    //const usuarioID = document.getElementById("formCategorias");

    const creador = localStorage.getItem("ID");;


    formData.append("nombre", nombre);
    formData.append("descripcion", descripcion);
    formData.append("creador", creador);
    if (!creador) {
        alert("No se encontró el ID del creador en Local Storage.");
        return;
    }
    console.log("Datos enviados:", { nombre, descripcion, creador });

    fetch("./Controllers/CategoriaS.php", {
        method: "POST",
        body: formData
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Categoría guardada correctamente.");
                // Aquí puedes recargar la lista de categorías si es necesario
            } else {
                alert("Error al guardar la categoría: " + data.message);
            }
        })
    // .catch(error => {
    //     console.error("Error al procesar la solicitud:", error);
    // });




    // if (editando) {
    //     // categorias[indiceCategoriaEditar].nombre = nombre;
    //     // categorias[indiceCategoriaEditar].descripcion = descripcion;
    //     alert('Categoría actualizada con éxito');
    // } else {

    //     const existe = categorias.findIndex(c => c.nombre.toLowerCase() === nombre.toLowerCase());

    //     if (existe !== -1) {

    //         categorias[existe].descripcion = descripcion;
    //         categorias[existe].admin = adminName;
    //         categorias[existe].fecha = fechaCreacion;
    //         alert('Categoría actualizada con éxito');
    //     } else {

    //         categorias.push({
    //             nombre: nombre,
    //             descripcion: descripcion,
    //             admin: adminName,
    //             fecha: fechaCreacion
    //         });
    //         alert('Categoría agregada con éxito');
    //     }
    // }


    resetForm();
    mostrarCategorias();
}

document.addEventListener('DOMContentLoaded', function () {
    mostrarCategorias(); // Cargar las categorías al inicio
});

function getTableBody() {
    return document.getElementById("tablaCategorias");
}
let userdata = [];
function listarUsuarios() {
    const tableBody = getTableBody();
    tableBody.innerHTML = "";
    catdata.forEach((cat) => {
        tableBody.appendChild(cat.catelist);
    });
}

async function mostrarCategorias() {
    let response = await fetch("./Controllers/CategoriaL.php", {
        // action: 'listar',
        headers: { "Content-Type": "application/json" },

    });
    //  const userType = localStorage.setItem('Text', document.getElementById("reporteToggle").textContent)
    let responseJSON = await response.json();
    catdata = []; // Limpia datos anteriores

    if (Array.isArray(responseJSON)) {
        responseJSON.forEach((r) => {
            let newCat = new Categorie(
                r.Nombre,
                r.Descripcion,
                r.Creador,
                r.Creacion
            );
            catdata.push(newCat);
        });
        listarUsuarios();
    } else {
        console.error(responseJSON.error || "Error desconocido.");
    }
    // } catch (error) {
    //     console.error("Error al obtener datos:", error);
    // }
    // try {
    //     // Llamada al backend para obtener categorías
    //     const response = await fetch("./Controllers/categoria.php?action=listar");
    //     const categorias = await response.json(); // Parsear respuesta JSON

    //     if (response.ok) {
    //         const tabla = document.getElementById('tablaCategorias');
    //         tabla.innerHTML = ''; // Limpiar tabla antes de llenarla

    //         // Llenar la tabla con los datos obtenidos
    //         categorias.forEach((categoria) => {
    //             const fila = `
    //                 <tr>
    //                     <td>${categoria.Nombre}</td>
    //                     <td>${categoria.Descripcion}</td>
    //                     <td>${categoria.Creador}</td>
    //                     <td>${categoria.Creacion}</td>
    //                 </tr>
    //             `;
    //             tabla.innerHTML += fila;
    //         });
    //     } else {
    //         console.error("Error al obtener datos: ", categorias.error || "Error desconocido");
    //     }
    // } catch (error) {
    //     console.error("Error al conectar con el servidor:", error);
    // }
}


function editarCategoria(Nombre, Descripcion, Creador) {
    //   const categoria = Categorie[nombre];
    document.getElementById('nombreCategoria').value = Nombre;
    document.getElementById('descripcionCategoria').value = Descripcion;
    document.getElementById('adminName').value = Creador;
    editando = true;
    // indiceCategoriaEditar = index; 
}

// Función para eliminar una categoría
function eliminarCategoria(nombre) {
    const fila = document.querySelector(`tr[data-nombre="${nombre}"]`);
    if (fila) {
        fila.classList.add("hidden"); // Agrega la clase para ocultarla
    }
}


function resetForm() {
    document.getElementById('nombreCategoria').value = '';
    document.getElementById('descripcionCategoria').value = '';
    editando = false;
    indiceCategoriaEditar = -1;
}
