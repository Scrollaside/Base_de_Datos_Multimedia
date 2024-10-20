//Muestra o oculta el cuadro del boton para los cursos
const item = document.getElementById('item');
//const icon = item.querySelector('i');
const cuadro = document.getElementById('cuadro');
//item.addEventListener('click', () => {
//    icon.classList.toggle('rotacion');
//    cuadro.classList.toggle('activo');
//});
//Muestra o oculta el cuadro del boton para los cursos

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
    window.location.href = "cursoCompleto.html";
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

function handleCheckboxes(opcion) {
  const cursoCompleto = document.getElementById('fullCourseCheckbox');
  const nivelIndividual = document.getElementById('individualLevelsCheckbox');
  const opciones = document.getElementById('levelOptions');
  
  if (opcion === 'full') {
      // Si se selecciona "Curso completo", desmarcar "Niveles individuales" y ocultar opciones
      nivelIndividual.checked = false;
      cursoCompleto.checked = true;  // Asegurarse que esté marcado
      opciones.style.display = 'none';  // Ocultar opciones de niveles
      document.getElementById('pago-contenido').innerHTML = "Precio del curso completo: $500.";
  } else if (opcion === 'individual') {
      // Si se selecciona "Niveles individuales", desmarcar "Curso completo" y mostrar opciones
      cursoCompleto.checked = false;
      nivelIndividual.checked = true;  // Asegurarse que esté marcado
      opciones.style.display = 'block';  // Mostrar opciones de niveles
      precio.innerHTML = "Precio del nivel 1: $100.";
  }
}


const precio = document.getElementById('pago-contenido');
function cambiarPrecio(){
  var nivelSelec = document.getElementById('levelSelect').value;
  console.log("Entre" + nivelSelec);
  switch(nivelSelec){
    case "1": {
      console.log("Entre");
      precio.innerHTML = "Precio del nivel 1: $100.";
      break;
    }
    case "2": {
      precio.innerHTML = "Precio del nivel 2: $150.";
      break;
    }
  }

};



document.addEventListener("keyup", function(event){
  if(event.key === "j"){
    document.getElementById('opciones-compra').style.display = "block";
    document.getElementById('gratuito').style.display = "none";
    document.getElementById('pago').style.display = "block";
  }else if (event.key === "k"){
    document.getElementById('opciones-compra').style.display = "none";
    document.getElementById('gratuito').style.display = "block";
    document.getElementById('pago').style.display = "none";
  }
});