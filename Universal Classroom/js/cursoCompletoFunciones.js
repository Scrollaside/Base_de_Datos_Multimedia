const idNivel = localStorage.getItem("idNivelMostrar");
const idCurso = localStorage.getItem("idCurso");
let url;
window.addEventListener("DOMContentLoaded", function () {
    
    setTimeout(() => {
        fetch('./Controllers/DetalleCurso.php', {
            method: "POST",
            body: JSON.stringify({ ID: idCurso, idNivel: idNivel, option: 3 })
        })
        .then(response => response.json())
        .then(data => {
            if(data){
                console.log(data);
                url = data.nivel.Video;
                const nombreCurso = document.getElementById("NombreCurso");
                nombreCurso.innerHTML = data.curso.NombreCurso;
                const nivelNombre = document.getElementById("nivelNombre");
                nivelNombre.innerHTML = data.nivel.Nombre + ' - recursos';
                const recursosNivel = document.getElementById("recursosNivel");
                if(data.nivel.Documento !== null){
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
                if(data.nivel.Link !== null){
                    recursosNivel.innerHTML += `
                    <div class="tab">
                        <label for="">
                            <a id="linkNivel">${data.nivel.Link}</a>
                        </label>
                    </div>
                    `;
                }
                if(data.nivel.Video !== null){
                    recursosNivel.innerHTML += `
                    <div class="tab">
                        <label for="video">
                        <h4 id="video">Ver video:</h4>
                        </label>
                    </div>
                    `;
                }
                
            }
        })
        .catch(error => {
            alert("Error de red: " + error.message);
        });

        setTimeout(() => {
            const vid = document.getElementById("video");
            vid.addEventListener('click', function(){
                document.getElementById('courseVideo').setAttribute('src', './docs/' + url);
            });
        }, 100);
    }, 300);
    
    
    // Funcionalidad para cambiar el video según el tema seleccionado
    document.querySelectorAll('.topics li').forEach(item => {
        item.addEventListener('click', function () {
            const videoSrc = this.getAttribute('data-video');
            document.getElementById('courseVideo').setAttribute('src', './docs/video.mp4');
            document.getElementById('courseVideo').play();
        });
    });
});

