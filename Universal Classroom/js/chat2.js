const idNivelC = parseInt(localStorage.getItem("idNivelMostrar"));
const idUsuario = parseInt(localStorage.getItem("ID"));
const idCreador = parseInt(localStorage.getItem("idCreador"));

window.addEventListener("DOMContentLoaded", function () {

    obtenerMensajes();
});

function obtenerMensajes() {
    fetch('./Controllers/Mensaje.php', {
        method: "POST",
        body: JSON.stringify({ idCreador: idCreador, option: 4 })
    }).then(response => response.json())
        .then(data => {
            if (data) {
                console.log(data);
                const alumnos = Array.isArray(data.alumnos) ? data.alumnos : [data.alumnos];
                const miembrosContenedor = document.getElementById("miembros");
                console.log(alumnos);
                for(let i = 0; i < alumnos.length; i++){
                  miembrosContenedor.innerHTML += `
                <li class="person" data-chat="${alumnos[i].UsuarioID}" id="${alumnos[i].UsuarioID}">
                     <img src="img/user.png" alt="" id="${alumnos[i].UsuarioID}"/>
                     <span class="name" id="${alumnos[i].UsuarioID}">${alumnos[i].NombreUsuario}</span>
                     <span class="time" id="ultimoMsjIzqTiempo"></span>
                     <span class="preview" id="ultimoMsjIzqText"></span>
                 </li>
               `;
                }
                const activos = document.querySelectorAll(".person");
                activos.forEach(activo => {
                    activo.addEventListener('click', e => {
                        const person = document.querySelectorAll("li.active");
                        let idPersona = parseInt(e.target.getAttribute("id"));
                        if (person.length === 0) {
                            activo.classList.add('active');
                        } else {
                            document.querySelector('.active').classList.remove('active');
                            activo.classList.add('active');
                        }
                        mostrarChats(idPersona);
                    });
                });
            }
        })
        .catch(error => {
            alert("Error al obtener mensajes: " + error.message);
        });
}

function mostrarChats(idPersona) {

    const chatContenedor = document.getElementById("chatContenedor");
    chatContenedor.innerHTML = `
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
                        <div class="message-text">${data.mensajes[i].Texto}</div>
                        <div class="message-time">${data.mensajes[i].Fecha}</div>
                    </div>
                  `;
                    } else {
                        contenedorChat.innerHTML += `
                    <div class="bubble you">
                        <div class="message-text">${data.mensajes[i].Texto}</div>
                        <div class="message-time">${data.mensajes[i].Fecha}</div>
                    </div>
                  `;
                    }
                }
                contenedorChat.scrollTop = contenedorChat.scrollHeight;
            } else {
                console.log('No hay mensajes');
            }
            const btnEnviar = document.getElementById("sendButton");
            btnEnviar.addEventListener('click', function () {
                const texto = document.getElementById("sendInput").value;
                if (texto !== '') {
                    fetch('./Controllers/Mensaje.php', {
                        method: "POST",
                        body: JSON.stringify({ texto: texto, idNivel: idNivelC, idUsuarioChat: idPersona, idUsuarioIS: idUsuario, option: 3 })
                    })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                console.log('mensaje enviado');
                                const contenedorChat = document.getElementById('chat-' + idPersona);
                                contenedorChat.innerHTML += `
                                    <div class="bubble me">
                                        <div class="message-text">${texto}</div>
                                        <div class="message-time">Justo ahora</div>
                                    </div>
                                    
                                    `;
                                contenedorChat.scrollTop = contenedorChat.scrollHeight;
                                const limpiar = document.getElementById("sendInput");
                                limpiar.value = '';
                            }
                        })
                        .catch(error => {
                            alert("Error al mandar mensaje: " + error.message);
                        });
                }
            });
        })
        .catch(error => {
            alert("Error de red: " + error.message);
        });
}
