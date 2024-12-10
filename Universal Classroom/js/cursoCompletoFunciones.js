const idNivel = localStorage.getItem("idNivelMostrar");
const idCurso = localStorage.getItem("idCurso");
const idUsuarioNiv = parseInt(localStorage.getItem("ID"));
let url;
let data;
window.addEventListener("DOMContentLoaded", function () {

    fetch('./Controllers/DetalleCurso.php', {
        method: "POST",
        body: JSON.stringify({ ID: idCurso, idNivel: idNivel, option: 3 })
    })
        .then(response => response.json())
        .then(data => {
            if (data) {
                url = data.nivel.Video;
                const nombreCurso = document.getElementById("NombreCurso");
                nombreCurso.innerHTML = data.nivel.Nombre;
                const nivelNombre = document.getElementById("nivelNombre");
                nivelNombre.innerHTML = data.nivel.Descripcion + ' - recursos';
                const recursosNivel = document.getElementById("recursosNivel");
                const btnTerminarNivel = document.getElementById("terminar-nivel");
                if (data.nivel.Documento !== null) {
                    recursosNivel.innerHTML += `
                    <div class="tab">
                        <label for="documentoNivel">
                            <h4>Archivos relacionados: 
                            <a id="documentoNivel" href="${data.nivel.Documento}" download style="color: black;">Descargar pdf</a>
                            </h4>
                        </label>
                    </div>
                    `;
                }
                if (data.nivel.Link !== null) {
                    recursosNivel.innerHTML += `
                    <div class="tab">
                        <label for="">
                            <a id="linkNivel">${data.nivel.Link}</a>
                        </label>
                    </div>
                    `;
                }
                if (data.nivel.Video !== null) {
                    recursosNivel.innerHTML += `
                    <div class="tab">
                        <label for="video">
                        <h4 id="video">Ver video:</h4>
                        </label>
                    </div>
                    `;
                }
                btnTerminarNivel.innerHTML = `
                    <div class="tab-btn">
                        <label for="btnCompletar">
                        <h4 id="btnCompletar">COMPLETAR CURSO</h4>
                        </label>
                    </div>
                    `;
            }
            if (url !== null) {
                const vid = document.getElementById("video");
                vid.addEventListener('click', function () {
                    document.getElementById('courseVideo').setAttribute('src', './docs/' + url);
                });
            }
            const btnTerNiv = document.getElementById("btnCompletar");
            btnTerNiv.addEventListener('click', function () {
                actualizarNivelEstado();
                console.log("Se completó el curso c:");
            });

            // Funcionalidad para cambiar el video según el tema seleccionado
            document.querySelectorAll('.topics li').forEach(item => {
                item.addEventListener('click', function () {
                    const videoSrc = this.getAttribute('data-video');
                    document.getElementById('courseVideo').setAttribute('src', './docs/video.mp4');
                    document.getElementById('courseVideo').play();
                });
            });
            // Funcionalidad para cambiar el video según el tema seleccionado
        })
        .catch(error => {
            alert("Error de red: " + error.message);
        });
});

function actualizarNivelEstado(){
    fetch('./Controllers/DetalleCurso.php', {
        method: "POST",
        body: JSON.stringify({ option: 8, IdNivel: idNivel, IdUsuario: idUsuarioNiv })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert("Feliciades! Terminaste el curso! c:");
            } else {
                alert("Error");
            }
        })
        .catch(error => console.error('Error al actualizar el curso: ', error));
}