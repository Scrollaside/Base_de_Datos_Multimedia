window.addEventListener("DOMContentLoaded", function() {

    var ID = 31;

    fetch('./Controllers/DetalleCurso.php', {
        method: "POST",
        body: JSON.stringify({ID: ID, option: 1})
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            console.log(data);
            //console.log(data.niveles[0].Costo);

            //Datos del curso
            const titulo = document.getElementById("Titulo");
            titulo.innerHTML = data.curso.NombreCurso;
            const creador = document.getElementById("Creador");
            creador.innerHTML = 'Impartido por: ' + data.curso.Creador;
            const descripcion = document.getElementById("Descripcion");
            descripcion.innerHTML = data.curso.Descripcion;
            const costo = document.getElementById("Costo");
            const rating = data.curso.Rating;
            const estrellas = document.getElementById("Estrellas");
            const estrellas2 = document.getElementById("Estrellas2");
            
            agregarEstrellas(rating, estrellas);
            agregarEstrellas(rating, estrellas2);

            const puntuacion1 = document.getElementById("Puntuacion1");
            //puntuacion1.innerHTML = data.curso.

            if(data.curso.Precio === 0){
                costo.innerHTML += `
                <i class="fa-solid fa-heart" style="color: #dd3131;"></i>
                <span>Curso gratis</span>
                `;
            }else{
                costo.innerHTML += `
                <i class="fa-solid fa-cart-shopping" style="color: #63E6BE;"></i>
                <span>$ ${data.curso.Precio}</span>
                `;
            }
            //Datos del curso

            //Pago
            if(data.curso.Precio === 0){
                document.getElementById('opciones-compra').style.display = "none";
                document.getElementById('gratuito').style.display = "block";
                document.getElementById('pago').style.display = "none";

                // Acceder al curso gratis
                document.getElementById('freeAccessBtn').addEventListener('click', function () {
                    window.location.href = "cursoCompleto.php";
                });
            }else{
                document.getElementById('opciones-compra').style.display = "block";
                document.getElementById('gratuito').style.display = "none";
                document.getElementById('pago').style.display = "block";

                const precioHtml = document.getElementById('pago-contenido');
                const combo = document.getElementById("levelOptions");

                const cursoCompleto = document.getElementById('fullCourseCheckbox');
                const nivelIndividual = document.getElementById('individualLevelsCheckbox');

                cursoCompleto.addEventListener('click', function () {
                    handleCheckboxes('full', cursoCompleto, nivelIndividual, precioHtml, combo, data.curso.Precio);
                });

                nivelIndividual.addEventListener('click', function () {
                    handleCheckboxes('individual', cursoCompleto, nivelIndividual, precioHtml, combo, 0);
                });
            }
            //Pago

             //Niveles
             const niveles = document.getElementById("Niveles");
             const opciones = document.getElementById('levelSelect');
             console.log(opciones.value);
             for(let i = 0; i < data.curso.ProgramaCurso; i++){
                 niveles.innerHTML += `
                     <div class="tab">
                         <label for="" id="tab-${i}">
                             <h4>${data.niveles[i].Nombre}</h4>
                         </label>
                     </div>
                     `;

                     opciones.innerHTML += `
                     <option value="${data.niveles[i].IdNivel}">${data.niveles[i].Nombre}</option>
                     `;
             }
            opciones.addEventListener('change', function () {
                const precioHtml = document.getElementById('pago-contenido');
                cambiarPrecio(precioHtml);
            });
             //Niveles

            //Comentarios
            if(data.comentarios !== 'no'){
                const comentariosCurso = document.getElementById("lista-comentarios");
                const barra1 = document.getElementById("Porcentaje1");
                const barra2 = document.getElementById("Porcentaje2");
                const barra3 = document.getElementById("Porcentaje3");
                const barra4 = document.getElementById("Porcentaje4");
                const barra5 = document.getElementById("Porcentaje5");
                const progreso1 = document.getElementById("Progreso1");
                const progreso2 = document.getElementById("Progreso2");
                const progreso3 = document.getElementById("Progreso3");
                const progreso4 = document.getElementById("Progreso4");
                const progreso5 = document.getElementById("Progreso5");
                let conteo1 = 0, conteo2 = 0, conteo3 = 0, conteo4 = 0, conteo5 = 0;
                for(let i = 0; i < Object.keys(data.comentarios).length; i++){
                    comentariosCurso.innerHTML += `
                    <li class="fila-comentario" name="user-comment">
                        <a href="" class="user">
                            <img src="img/user.png" alt="Foto-usuario" width="56" height="56" loading="lazy">
                        </a>
                        <div>
                            <a href="">${data.comentarios[i].NombreComentario}</a>
                            <div class="valoracion">
                                <ul class="star" id="Estrellas-${i}">
                                    
                                </ul>
                                <div class="fecha-comentario">${data.comentarios[i].FechaComentario}
                                </div>
                            </div>
                            <p class="informacion-comentario">${data.comentarios[i].Comentario}</p>
                        </div>
                    </li>
                    `;
                    const calificacionCom = data.comentarios[i].CalificacionComentario;
                    const estrellasCom = document.getElementById(`Estrellas-${i}`);
                    agregarEstrellas(calificacionCom, estrellasCom);
                    console.log(data.comentarios[i].CalificacionComentario);
                    switch(data.comentarios[i].CalificacionComentario){
                        case 1:{
                            conteo1++;
                            barra5.innerHTML = conteo1;
                            progreso5.style = 'width: ' + conteo1 + '%';
                            break;
                        }
                        case 2:{
                            conteo2++;
                            barra4.innerHTML = conteo2;
                            progreso4.style = 'width: ' + conteo2 + '%';
                            break;
                        }
                        case 3:{
                            conteo3++;
                            barra3.innerHTML = conteo3;
                            progreso3.style = 'width: ' + conteo3 + '%';
                            break;
                        }
                        case 4:{
                            conteo4++;
                            barra2.innerHTML = conteo4;
                            progreso2.style = 'width: ' + conteo4 + '%';
                            break;
                        }
                        case 5:{
                            conteo5++;
                            barra1.innerHTML = conteo5;
                            progreso1.style = 'width: ' + conteo5 + '%';
                            break;
                        }
                    }
                }
            }
            //Comentarios

        } else {
            alert("Error")
        }
    })
    .catch(error => {
        alert ("Error de red: " + error.message);
    });
});

function agregarEstrellas(calificacion, elemento){
    const trunc = Math.trunc(calificacion);
    var comparador = calificacion - trunc;
    let estrellita;
    let conteo = 0;

    if (comparador === 0) {
        estrellita = 'no';
    } else if (comparador > 0 && comparador <= 0.9) {
        estrellita = 'media';
    }
    
    for (let i = 0; i < trunc; i++) {
        elemento.innerHTML += `
                <li>
                    <i class="fa-solid fa-star" style="color: #FFD43B;"></i>
                </li>
                `;
                conteo++;
    }
    switch (estrellita) {
        case 'no': {
            break;
        }
        case 'media': {
            elemento.innerHTML += `
                    <li>
                        <i class="fa-solid fa-star-half-stroke" style="color: #FFD43B;"></i>
                    </li>
                    `;
                    conteo++;
            break;
        }
    }
    if(conteo < 5){
        for(let j = 0; j < 5 - conteo; j++){
            elemento.innerHTML += `
                    <li>
                        <i class="fa-regular fa-star" style="color: #FFD43B;"></i>
                    </li>
                    `;
        }
    }
}

function handleCheckboxes(opcion, elemento1, elemento2, precioHtml, combo, precio) {

    if (opcion === 'full') {
        // Si se selecciona "Curso completo", desmarcar "Niveles individuales" y ocultar opciones
        elemento2.checked = false;
        elemento1.checked = true;  // Asegurarse que esté marcado
        combo.style.display = 'none';  // Ocultar opciones de niveles
        precioHtml.innerHTML = 'Precio por el curso completo: $' + precio;
    } else if (opcion === 'individual') {        
        // Si se selecciona "Niveles individuales", desmarcar "Curso completo" y mostrar opciones
        elemento1.checked = false;
        elemento2.checked = true;  // Asegurarse que esté marcado
        combo.style.display = 'block';  // Mostrar opciones de niveles
    }
}

function cambiarPrecio(precioHtml) {
    var nivelSelec = document.getElementById('levelSelect').value;

    fetch('./Controllers/DetalleCurso.php', {
        method: "POST",
        body: JSON.stringify({ option: 2, IdNivel: nivelSelec })
    })
    .then(response => response.json())
    .then(data => {
        if(data.success){
            console.log(data);
            precioHtml.innerHTML = data.nivel.Nombre + ' Costo: $' + data.nivel.Costo;
            localStorage.setItem('costoNivel', data.nivel.Costo);
        }else{
            alert("Error");
        }
    })
    .catch(error => console.error('Error al cargar la barra de navegación:', error));
    
}