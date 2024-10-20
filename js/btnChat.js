// Obtener elementos
const chatBtn = document.getElementById('mensajeBtn');
const chatWindow = document.getElementById('mensajeWindow');
const chatWindow2 = document.getElementById('mensajeWindow2');
let comparador = 1;
//const closeChat = document.getElementById('closeChat');
//const sendMessage = document.getElementById('sendMessage');
//const chatMessage = document.getElementById('chatMessage');
//const messages = document.querySelector('.messages');

// Mostrar el chat
chatBtn.addEventListener('click', () => {
    if(comparador === 1){
        chatWindow.style.display = 'block';
        chatWindow2.style.display = 'block';
        comparador = 2;
    }else if(comparador === 2){
        chatWindow.style.display = 'none';
        chatWindow2.style.display = 'none';
        comparador = 1;
    }
    
});

// Cerrar el chat
//closeChat.addEventListener('click', () => {
//    chatWindow.style.display = 'none';
//});

// Enviar mensaje
//sendMessage.addEventListener('click', () => {
//    const message = chatMessage.value;
//    if (message.trim()) {
//        const newMessage = document.createElement('div');
//        newMessage.classList.add('message');
//        newMessage.textContent = message;
//        messages.appendChild(newMessage);
//        chatMessage.value = ''; // Limpiar el input
//    }
//});
