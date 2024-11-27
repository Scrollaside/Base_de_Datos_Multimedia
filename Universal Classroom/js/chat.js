const idNivelC = parseInt(localStorage.getItem("idNivelMostrar"));
const idUsuario = parseInt(localStorage.getItem("ID"));
window.addEventListener("DOMContentLoaded", function () {

  setTimeout(() => {
    fetch('./Controllers/Mensaje.php', {
      method: "POST",
      body: JSON.stringify({ idNivel: idNivelC, option: 1 })
    }).then(response => response.json())
      .then(data => {
        if (data) {
          console.log(data);
          console.log(idUsuario);
          const miembrosContenedor = document.getElementById("miembros");
          for(let i = 0; i < Object.keys(data.miembros).length; i++){
            if (data.miembros[i]['IdUsuario'] !== idUsuario) {
              miembrosContenedor.innerHTML += `
              <li class="person" data-chat="${data.miembros[i]['IdUsuario']}" id="${data.miembros[i]['IdUsuario']}">
                   <img src="img/user.png" alt=""/>
                   <span class="name">${data.miembros[i]['Miembro']}</span>
                   <span class="time" id="ultimoMsjIzqTiempo"></span>
                   <span class="preview" id="ultimoMsjIzqText"></span>
               </li>
             `;
            }
          }


        }
      })
      .catch(error => {
        alert("Error de red: " + error.message);
      });  
  }, 200);
  
  // Obtener elementos
  const chatBtn = document.getElementById('mensajeBtn');
  const chatWindow = document.getElementById('mensajeWindow');
  const chatWindow2 = document.getElementById('mensajeWindow2');
  let comparador = 1;

  // Mostrar el chat
  chatBtn.addEventListener('click', () => {
    if (comparador === 1) {
      chatWindow.style.display = 'block';
      chatWindow2.style.display = 'block';
      comparador = 2;
    } else if (comparador === 2) {
      chatWindow.style.display = 'none';
      chatWindow2.style.display = 'none';
      comparador = 1;
    }

    

    setTimeout(() => {
      const activos = document.querySelectorAll(".person");
      activos.forEach(activo => {
        activo.addEventListener('click', e => {
          let idPersona = parseInt(e.target.getAttribute("id"));
          const chatContenedor = document.getElementById("chatContenedor");
          chatContenedor.innerHTML = `
          <div class="top"><span>To: <span class="name" id="nombreDestinatario"></span></span></div>
          <div class="chat" id="chat-${idPersona}"></div>
           <div class="write">
                    <a href="javascript:;" class="write-link attach"></a>
                    <input type="text" />
                    <a href="javascript:;" class="write-link smiley"></a>
                    <a href="javascript:;" class="write-link send"></a>
                </div>
          `;

          activo.classList.add('active');
          console.log(idPersona);
          document.getElementById('chat-' + idPersona).classList.add('active-chat');

          fetch('./Controllers/Mensaje.php', {
            method: "POST",
            body: JSON.stringify({ idNivel: idNivelC, idUsuarioChat: idPersona, idUsuarioIS: idUsuario, option: 2 })
          }).then(response => response.json())
            .then(data => {
              if (data.success) {
               console.log(data);
               const contenedorChat = document.getElementById('chat-' + idPersona);
               for(let i = 0; i < Object.keys(data.mensajes).length; i++){
                if(data.mensajes[i].Remitente === idUsuario){
                  contenedorChat.innerHTML += `
                    <div class="bubble me">
                        ${data.mensajes[i].Texto}
                    </div>
                  `;
                }else{
                  contenedorChat.innerHTML += `
                    <div class="bubble you">
                        ${data.mensajes[i].Texto}
                    </div>
                  `;
                }
               }
              }else{
                alert('No hay mensajes');
              }
            })
            .catch(error => {
              alert("Error de red: " + error.message);
            }); 
        });
      });
    }, 300);
  });
  // Mostrar el chat


  // document.querySelector('.chat[data-chat=person2]').classList.add('active-chat')
  // document.querySelector('.person[data-chat=person2]').classList.add('active')

  // let friends = {
  //   list: document.querySelector('ul.people'),
  //   all: document.querySelectorAll('.left .person'),
  //   name: ''
  // },
  //   chat = {
  //     container: document.querySelector('.mensajes .right'),
  //     current: null,
  //     person: null,
  //     name: document.querySelector('.mensajes .right .top .name')
  //   }

  // friends.all.forEach(f => {
  //   f.addEventListener('mousedown', () => {
  //     f.classList.contains('active') || setAciveChat(f)
  //   })
  // });

  // function setAciveChat(f) {
  //   friends.list.querySelector('.active').classList.remove('active')
  //   f.classList.add('active')
  //   chat.current = chat.container.querySelector('.active-chat')
  //   chat.person = f.getAttribute('data-chat')
  //   chat.current.classList.remove('active-chat')
  //   chat.container.querySelector('[data-chat="' + chat.person + '"]').classList.add('active-chat')
  //   friends.name = f.querySelector('.name').innerText
  //   chat.name.innerHTML = friends.name
  // }
});
