var ID = localStorage.getItem("idCurso");
var tipoUsuario = parseInt(localStorage.getItem("TipoUsuario"));
const idUsuario = parseInt(localStorage.getItem("ID"));
let nivelesNoInscritos;
window.addEventListener("DOMContentLoaded", function () {
    fetch('./Controllers/DetalleCurso.php', {
        method: "POST",
        body: JSON.stringify({ ID: ID, IdUsuario: idUsuario, option: 1 })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                localStorage.setItem('datosCurso', data);
                this.localStorage.setItem('idCreador', data.curso.IdCreador);
                if(tipoUsuario === 2){
                    agregarDetallesCurso(data);
                    agregarDetallesPago(data);
                    agregarComentarios(data);
                    agregarNiveles(data);
                }else{
                    agregarDetallesCurso(data);
                    agregarDetallesPago(data);
                    agregarComentarios(data);
                    agregarNiveles(data);
                    // Botón para tarjeta de debito
                    document.getElementById("debitoButton").addEventListener("click", function () {
                        const cursoCompleto = document.getElementById('fullCourseCheckbox');
                        if (cursoCompleto.checked) {
                            for (let i = 0; i < Object.keys(nivelesNoInscritos.niveles).length; i++) {
                                fetch('./Controllers/DetalleCurso.php', {
                                    method: "POST",
                                    body: JSON.stringify({ option: 5, IdNivel: nivelesNoInscritos.niveles[i].ID, IdUsuario: idUsuario, IdCurso: ID, metodoPago: 0 })
                                })
                                    .catch(error => console.error('Error al generar inscripcion: ', error));
                            }
                            alert("PAGO CON TARJETA DE DÉBITO REALIZADO CORRECTAMENTE");
                            location.reload();
                        } else {
                            var nivelSelec = document.getElementById('levelSelect').value;
                            console.log(nivelSelec);
                            fetch('./Controllers/DetalleCurso.php', {
                                method: "POST",
                                body: JSON.stringify({ option: 5, IdNivel: nivelSelec, IdUsuario: idUsuario, IdCurso: ID, metodoPago: 0 })
                            })
                                .catch(error => console.error('Error al cambiar el precio: ', error));
                            alert("PAGO CON TARJETA DE DÉBITO REALIZADO CORRECTAMENTE");
                            location.reload();
                        }

                    });
                    // Botón para tarjeta de debito

                    // Botón para tarjeta de credito
                    document.getElementById("creditoButton").addEventListener("click", function () {
                        const cursoCompleto = document.getElementById('fullCourseCheckbox');
                        if (cursoCompleto.checked) {
                            for (let i = 0; i < Object.keys(nivelesNoInscritos.niveles).length; i++) {
                                fetch('./Controllers/DetalleCurso.php', {
                                    method: "POST",
                                    body: JSON.stringify({ option: 5, IdNivel: nivelesNoInscritos.niveles[i].ID, IdUsuario: idUsuario, IdCurso: ID, metodoPago: 1 })
                                })
                                    .catch(error => console.error('Error al cambiar el precio: ', error));
                            }
                            alert("PAGO CON TARJETA DE DÉBITO REALIZADO CORRECTAMENTE");
                            location.reload();
                        } else {
                            var nivelSelec = document.getElementById('levelSelect').value;
                            console.log(nivelSelec);
                            fetch('./Controllers/DetalleCurso.php', {
                                method: "POST",
                                body: JSON.stringify({ option: 5, IdNivel: nivelSelec, IdUsuario: idUsuario, IdCurso: ID, metodoPago: 1 })
                            })
                                .catch(error => console.error('Error al cambiar el precio: ', error));
                            alert("PAGO CON TARJETA DE DÉBITO REALIZADO CORRECTAMENTE");
                            location.reload();
                        }

                    });
                    // Botón para tarjeta de credito
                }

            } else {
                alert("Error")
            }
        })
        .catch(error => {
            alert("Error al obtener detalles curso: " + error.message);
        });
});

function agregarNiveles(data){
    console.log(data);
    const programaCurso = document.getElementById("programaCurso");
    if(tipoUsuario === 2){
        programaCurso.innerHTML = 'Programa del curso - Instructor';
        //Niveles
        const niveles = document.getElementById("Niveles");
        const opciones = document.getElementById('levelSelect');
        console.log(data.curso);
        for (let i = 0; i < data.curso.ProgramaCurso; i++) {
            niveles.innerHTML += `
          <div class="tab">
              <label for="" id="tab-${i}">
                  <h4 class="lvlContenedor" id=${data.niveles[i].IdNivel}>${data.niveles[i].Nombre}</h4>
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
    }else if (data.inscripcion === 'no') {
        console.log('entre a no');
        programaCurso.innerHTML = 'Programa del curso - No está inscrito';
        //Niveles
        const niveles = document.getElementById("Niveles");
        const opciones = document.getElementById('levelSelect');
        console.log(data.curso);
        for (let i = 0; i < data.curso.ProgramaCurso; i++) {
            niveles.innerHTML += `
          <div class="tab">
              <label for="" id="tab-${i}">
                  <h4 class="lvlContenedorNo" id=${data.niveles[i].IdNivel}>${data.niveles[i].Nombre}</h4>
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
    }else{
        programaCurso.innerHTML = 'Programa del curso - Alumno inscrito';
        //Niveles
        const niveles = document.getElementById("Niveles");
        const opciones = document.getElementById('levelSelect');
        console.log(data.curso);
        let esta = false;
        let comparador = data.curso.ProgramaCurso;
        let indice = 0;
        if(data.inscripcion.length > 1){
            for (let i = 0; i < data.curso.ProgramaCurso; i++) {
                for (let j = 0; j < Object.keys(data.inscripcion).length; j++) {
                    if(data.niveles[i].IdNivel === data.inscripcion[j].IdNivel){
                        esta = true;
                        j = Object.keys(data.inscripcion).length + 1;
                    }
                }
                if(esta){
                    niveles.innerHTML += `
              <div class="tab">
                  <label for="" id="tab-${i}">
                      <h4 class="lvlContenedor" id=${data.niveles[i].IdNivel}>${data.niveles[i].Nombre}</h4>
                  </label>
              </div>
              `;
              esta = false;
              indice++;
              if(indice === comparador){
                document.getElementById('opciones-compra').style.display = "none";
                const precioHtml = document.getElementById('pago-contenido');
                precioHtml.innerHTML = "Ya posees el curso completo c:";             
              }
                }else{
                    niveles.innerHTML += `
              <div class="tab">
                  <label for="" id="tab-${i}">
                      <h4 class="lvlContenedorNo" id=${data.niveles[i].IdNivel}>${data.niveles[i].Nombre}</h4>
                  </label>
              </div>
              `;
              opciones.innerHTML += `
              <option value="${data.niveles[i].IdNivel}">${data.niveles[i].Nombre}</option>
              `;
              esta = false;
                }
            }
        }else{
            for (let i = 0; i < data.curso.ProgramaCurso; i++) {
                if(data.niveles[i].IdNivel === data.inscripcion[0].IdNivel){
                    niveles.innerHTML += `
              <div class="tab">
                  <label for="" id="tab-${i}">
                      <h4 class="lvlContenedor" id=${data.niveles[i].IdNivel}>${data.niveles[i].Nombre}</h4>
                  </label>
              </div>
              `;
                }else{
                    niveles.innerHTML += `
              <div class="tab">
                  <label for="" id="tab-${i}">
                      <h4 class="lvlContenedorNo" id=${data.niveles[i].IdNivel}>${data.niveles[i].Nombre}</h4>
                  </label>
              </div>
              `;
              opciones.innerHTML += `
              <option value="${data.niveles[i].IdNivel}">${data.niveles[i].Nombre}</option>
              `;
                }
            }
        }
        opciones.addEventListener('change', function () {
            const precioHtml = document.getElementById('pago-contenido');
            cambiarPrecio(precioHtml);
        });
        //Niveles

        const ns = document.querySelectorAll(".lvlContenedor");
        ns.forEach(n => {
            n.addEventListener('click', e => {
                const idNvl = e.target.getAttribute("id");
                localStorage.setItem("idNivelMostrar", idNvl);
                window.location.href = "cursoCompleto.php";
            });
        });

        
    }
    opcionesPago();
}

function agregarComentarios(data) {
    //Comentarios
    if (data.comentarios !== 'no') {
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
        for (let i = 0; i < Object.keys(data.comentarios).length; i++) {
            if (tipoUsuario === 3) {
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
                            <div class="fecha-comentario"><button class="opcion-admin" id="${data.comentarios[i].IdComentario}">Eliminar comentario</button>
                            </div>
                            
                        </div>
                        <p class="informacion-comentario">${data.comentarios[i].Comentario}</p>
                    </div>
                </li>
                `;
            } else {
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
            }

            const calificacionCom = data.comentarios[i].CalificacionComentario;
            const estrellasCom = document.getElementById(`Estrellas-${i}`);
            agregarEstrellas(calificacionCom, estrellasCom);
            switch (data.comentarios[i].CalificacionComentario) {
                case 1: {
                    conteo1++;
                    barra5.innerHTML = conteo1;
                    progreso5.style = 'width: ' + conteo1 + '%';
                    break;
                }
                case 2: {
                    conteo2++;
                    barra4.innerHTML = conteo2;
                    progreso4.style = 'width: ' + conteo2 + '%';
                    break;
                }
                case 3: {
                    conteo3++;
                    barra3.innerHTML = conteo3;
                    progreso3.style = 'width: ' + conteo3 + '%';
                    break;
                }
                case 4: {
                    conteo4++;
                    barra2.innerHTML = conteo4;
                    progreso2.style = 'width: ' + conteo4 + '%';
                    break;
                }
                case 5: {
                    conteo5++;
                    barra1.innerHTML = conteo5;
                    progreso1.style = 'width: ' + conteo5 + '%';
                    break;
                }
            }
        }
    }
    //Comentarios

    //eliminar comentario admin
    if (tipoUsuario === 3) {
        const eliminarComentario = document.querySelectorAll(".opcion-admin");
        eliminarComentario.forEach(btn => {
            btn.addEventListener('click', e => {
                const idCom = e.target.getAttribute("id");
                fetch('./Controllers/DetalleCurso.php', {
                    method: "POST",
                    body: JSON.stringify({ option: 4, idComentario: idCom })
                })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            alert('comentario borrado correctamente.');
                            location.reload();
                        } else {
                            alert("Error");
                        }
                    })
                    .catch(error => console.error('Error al cambiar el precio: ', error));
            });
        });
    }
    //eliminar comentario admin
}

function agregarDetallesPago(data) {
    //Pago
    if (data.curso.Precio === 0) {
        document.getElementById('opciones-compra').style.display = "none";
        document.getElementById('gratuito').style.display = "block";
        document.getElementById('pago').style.display = "none";

        // Acceder al curso gratis
        document.getElementById('freeAccessBtn').addEventListener('click', function () {
            window.location.href = "cursoCompleto.php";
        });
    } else {
        document.getElementById('opciones-compra').style.display = "block";
        document.getElementById('gratuito').style.display = "none";
        document.getElementById('pago').style.display = "block";

        const precioHtml = document.getElementById('pago-contenido');
        const combo = document.getElementById("levelOptions");

        const cursoCompleto = document.getElementById('fullCourseCheckbox');
        const nivelIndividual = document.getElementById('individualLevelsCheckbox');

        cursoCompleto.addEventListener('click', function () {
            handleCheckboxes('full', cursoCompleto, nivelIndividual, precioHtml, combo);
        });

        nivelIndividual.addEventListener('click', function () {
            handleCheckboxes('individual', cursoCompleto, nivelIndividual, precioHtml, combo);
        });
    }
    //Pago
}

function agregarDetallesCurso(data) {
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
    const puntuacion2 = document.getElementById("Puntuacion2");
    puntuacion1.innerHTML = data.curso.Rating;
    puntuacion2.innerHTML = data.curso.Rating;

    if (data.curso.Precio === 0) {
        costo.innerHTML += `
    <i class="fa-solid fa-heart" style="color: #dd3131;"></i>
    <span>Curso gratis</span>
    `;
    } else {
        costo.innerHTML += `
    <i class="fa-solid fa-cart-shopping" style="color: #63E6BE;"></i>
    <span>$ ${data.curso.Precio}</span>
    `;
    }
    //Datos del curso
}

function agregarEstrellas(calificacion, elemento) {
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
    if (conteo < 5) {
        for (let j = 0; j < 5 - conteo; j++) {
            elemento.innerHTML += `
                    <li>
                        <i class="fa-regular fa-star" style="color: #FFD43B;"></i>
                    </li>
                    `;
        }
    }
}

function handleCheckboxes(opcion, elemento1, elemento2, precioHtml, combo) {

    if (opcion === 'full') {
        // Si se selecciona "Curso completo", desmarcar "Niveles individuales" y ocultar opciones
        elemento2.checked = false;
        elemento1.checked = true;  // Asegurarse que esté marcado
        combo.style.display = 'none';  // Ocultar opciones de niveles
        funcionCursoCompletoPago(precioHtml);
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
            if (data.success) {
                precioHtml.innerHTML = data.nivel.Nombre + ' Costo: $' + data.nivel.Costo;
            } else {
                alert("Error");
            }
        })
        .catch(error => console.error('Error al cambiar el precio: ', error));

}

function opcionesPago(){
    const cuadro = document.getElementById("payment-options");
    const cursoCompleto = document.getElementById('fullCourseCheckbox');
    const nivelIndividual = document.getElementById('individualLevelsCheckbox');
    var nivelSelec = document.getElementById('levelSelect');
    cursoCompleto.addEventListener('click', function () {
        if (cursoCompleto.checked) {
            cuadro.style = "display: block";
            nivelSelec.selectedIndex = 0;
        }
    });

    nivelSelec.addEventListener('change', function () {
        if (nivelSelec.value !== '--Selecciona un nivel--') {
            cuadro.style = "display: block";
        }
    });

    nivelIndividual.addEventListener('click', function () {
        if (nivelIndividual.checked) {
            if (nivelSelec.value !== '--Selecciona un nivel--') {
                cuadro.style = "display: block";
            } else {
                const precioHtml = document.getElementById('pago-contenido');
                precioHtml.innerHTML = '';
                cuadro.style = "display: none";
            }
        }
    });
}


function funcionCursoCompletoPago(precioHtml){
    fetch('./Controllers/DetalleCurso.php', {
        method: "POST",
        body: JSON.stringify({ ID: ID, IdUsuario: idUsuario, option: 6 })
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                let niveles = data.niveles;
                console.log(niveles[0]);
                var precioTotal = 0;
                if(niveles[0] !== undefined){
                    for(let i = 0; i < Object.keys(data.niveles).length; i++){
                        precioTotal += data.niveles[i].Costo;
                    }
                    precioHtml.innerHTML = 'Precio por el curso completo: $' + precioTotal;
                    nivelesNoInscritos = data;
                }else{
                    precioHtml.innerHTML = 'Precio por el curso completo: $' + data.niveles.Costo;
                    nivelesNoInscritos = data;
                }
                
            } else {
                alert("No hay niveles")
            }
        })
        .catch(error => {
            alert("Error al obtener niveles del curso: " + error.message);
        });
}