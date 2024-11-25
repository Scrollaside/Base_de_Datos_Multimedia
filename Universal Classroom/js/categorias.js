// const categorias = [
//     {
//         nombre: "Programación",
//         descripcion: "Cursos relacionados con el desarrollo de software",
//         admin: "Alfonso David Marcelo Ibarra Navarro",
//         fecha: "15 sept 2024, 10:00"
//     },
//     {
//         nombre: "Modelado",
//         descripcion: "Técnica de crear una imagen digital tridimensional de un objeto mediante un software CAD.",
//         admin: "Alfonso David Marcelo Ibarra Navarro",
//         fecha: "15 sept 2024, 12:10"
//     },
//     {
//         nombre: "Web",
//         descripcion: "Red informática.",
//         admin: "Alfonso David Marcelo Ibarra Navarro",
//         fecha: "12 octu 2022, 14:45"
//     },
//     {
//         nombre: "Dibujo",
//         descripcion: "Forma de expresión artística que consiste en crear imágenes sobre una superficie plana mediante líneas, trazos y formas.",
//         admin: "Alfonso David Marcelo Ibarra Navarro",
//         fecha: "21 abri 2021, 21:01"
//     },
//     {
//         nombre: "Marketing",
//         descripcion: "Conjunto de técnicas, estrategias y procesos que una marca o empresa implementa de manera ética para crear, comunicar, intercambiar y entregar ofertas o mensajes que dan valor e interesan a clientes, audiencias, socios, proveedores y personas en general.",
//         admin: "Alfonso David Marcelo Ibarra Navarro",
//         fecha: "04 juni 2018, 11:11"
//     }
// ];
class Categorie {
    constructor(nombre, descripcion, creador, creacion) {
        this.Nombre = nombre;
        this.Descripcion = descripcion;
        this.Creador = creador;
        this.Creacion = creacion; 
    }

    get catelist() {
        let row = document.createElement("tr");
        row.innerHTML = `
            <td>${this.Nombre}</td>
            <td>${this.Descripcion}</td>
            <td>${this.Creador}</td>
            <td>${this.Creacion}</td>
        `;
        return row;
    }
}

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
    let response = await fetch("./Controllers/Categoria.php", {
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
