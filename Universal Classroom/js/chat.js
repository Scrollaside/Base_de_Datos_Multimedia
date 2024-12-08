const idNivelC = parseInt(localStorage.getItem("idNivelMostrar"));
const idUsuario = parseInt(localStorage.getItem("ID"));

window.addEventListener("DOMContentLoaded", function () {

    obtenerMensajes();

    // Obtener elementos
    const chatBtn = document.getElementById('mensajeBtn');
    const chatWindow = document.getElementById('mensajeWindow');
    const chatWindow2 = document.getElementById('mensajeWindow2');
    let comparador = 1;

    // Mostrar el chat
    chatBtn.addEventListener('click', () => {
        const chatWrapper = document.getElementById('mensajeWindow');
    chatWrapper.style.display = chatWrapper.style.display === 'none' || chatWrapper.style.display === '' ? 'block' : 'none';
    });
});

function obtenerMensajes() {
    fetch('./Controllers/Mensaje.php', {
        method: "POST",
        body: JSON.stringify({ idNivel: idNivelC, option: 1 })
    }).then(response => response.json())
        .then(data => {
            if (data) {
                console.log(data);
                console.log(idUsuario);
                const miembrosContenedor = document.getElementById("miembros");
                for (let i = 0; i < Object.keys(data.miembros).length; i++) {
                    if (data.miembros[i]['IdUsuario'] !== idUsuario) {
                        miembrosContenedor.innerHTML += `
                <li class="person" data-chat="${data.miembros[i]['IdUsuario']}" id="${data.miembros[i]['IdUsuario']}">
                     <img src="img/user.png" alt="" id="${data.miembros[i]['IdUsuario']}"/>
                     <span class="name" id="${data.miembros[i]['IdUsuario']}">${data.miembros[i]['Miembro']}</span>
                     <span class="time" id="ultimoMsjIzqTiempo"></span>
                     <span class="preview" id="ultimoMsjIzqText"></span>
                 </li>
               `;
                    }
                }
                const activos = document.querySelectorAll(".person");
                activos.forEach(activo => {
                    activo.addEventListener('click', e => {
                        const person = document.querySelectorAll("li.active");
                        let idPersona = parseInt(e.target.getAttribute("id"));
                        if(person.length === 0){
                            activo.classList.add('active');
                        }else{
                            document.querySelector('.active').classList.remove('active');
                            activo.classList.add('active');
                        }
                        mostrarChats(idPersona, activo);
                    });
                });
            }
        })
        .catch(error => {
            alert("Error al obtener mensajes: " + error.message);
        });
}

function mostrarChats(idPersona, activo) {

    const chatContenedor = document.getElementById("chatContenedor");
    chatContenedor.innerHTML = `
          <div class="top"><span>To: <span class="name" id="nombreDestinatario"></span></span></div>
          <div class="chat" id="chat-${idPersona}"></div>
           <div class="write">
                    <input id="sendInput" type="text" placeholder="Escribe un mensaje..."/>
                     <button id="sendButton">Enviar</button>
                </div>
          `;
    document.getElementById('chat-' + idPersona).classList.add('active-chat');

    fetch('./Controllers/Mensaje.php', {
        method: "POST",
        body: JSON.stringify({ idNivel: idNivelC, idUsuarioChat: idPersona, idUsuarioIS: idUsuario, option: 2 })
    }).then(response => response.json())
        .then(data => {
            if (data.success) {
                console.log(data);
                const contenedorChat = document.getElementById('chat-' + idPersona);
                for (let i = 0; i < Object.keys(data.mensajes).length; i++) {
                    if (data.mensajes[i].Remitente === idUsuario) {
                        contenedorChat.innerHTML += `
                    <div class="bubble me">
                        ${data.mensajes[i].Texto}
                    </div>
                  `;
                    } else {
                        contenedorChat.innerHTML += `
                    <div class="bubble you">
                        ${data.mensajes[i].Texto}
                    </div>
                  `;
                    }
                }

                
            } else {
                console.log('No hay mensajes');
            }
            const btnEnviar = document.getElementById("sendButton");
                btnEnviar.addEventListener('click', function(){
                    const texto = document.getElementById("sendInput").value;
                    fetch('./Controllers/Mensaje.php', {
                        method: "POST",
                        body: JSON.stringify({ texto: texto, idNivel: idNivelC, idUsuarioChat: idPersona, idUsuarioIS: idUsuario, option: 3 })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if(data.success){
                            console.log('mensaje enviado');
                        }
                    })
                    .catch(error => {
                        alert("Error al mandar mensaje: " + error.message);
                    });
                });
        })
        .catch(error => {
            alert("Error de red: " + error.message);
        });
}
