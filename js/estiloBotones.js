//Muestra o oculta el cuadro del boton para los cursos
const item = document.getElementById('item');
const icon = item.querySelector('i');
const cuadro = document.getElementById('cuadro');
item.addEventListener('click', () => {
    icon.classList.toggle('rotacion');
    cuadro.classList.toggle('activo');
});
//Muestra o oculta el cuadro del boton para los cursos
html
//Muestra o oculta los enlaces de los videos en el programa del curso
const label = document.getElementById('tab-1');
const cuadroVideos = document.getElementById('ul-tab-1');
label.addEventListener('click', () =>{
    console.log("algo");
    cuadroVideos.classList.toggle('videos-activo');
});

const label2 = document.getElementById('tab-2');
const cuadroVideos2 = document.getElementById('ul-tab-2');
label2.addEventListener('click', () =>{
    console.log("algo");
    cuadroVideos2.classList.toggle('videos-activo');
});
//Muestra o oculta los enlaces de los videos en el programa del curso

// Mostrar el modal

// Obtener el modal
var modal = document.getElementById("myModal");

// Obtener el botón que abre el modal
var btn = document.getElementById("a"); // Cambia por el ID del botón que abre el modal

// Obtener el <span> que cierra el modal
var span = document.getElementsByClassName("close")[0];

// Cuando se haga clic en el botón, abrir el modal
btn.onclick = function() {
  modal.style.display = "flex";
}

// Cuando se haga clic en el <span> (x), cerrar el modal
span.onclick = function() {
  modal.style.display = "none";
}

// Cuando se haga clic fuera del modal, cerrarlo
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

// Acceder al curso gratis
document.getElementById('freeAccessBtn').addEventListener('click', function() {
    // Aquí se integraría la API de pago con PayPal
    window.location.href = "cursoCompleto.php";
});

// Pagar con tarjeta
document.getElementById('payWithCard').addEventListener('click', function() {
    // Aquí se integraría la API de pago con tarjeta
    alert('Integrar API de pago con tarjeta aquí');
});

// Pagar con PayPal
document.getElementById('payWithPaypal').addEventListener('click', function() {
    // Aquí se integraría la API de pago con PayPal
    alert('Integrar API de PayPal aquí');
});