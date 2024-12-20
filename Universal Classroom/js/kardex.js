document.addEventListener("DOMContentLoaded", () => {
    const estadoSelect = document.getElementById("estado");
    const progresoSelect = document.getElementById("progreso");
    const fechaInicioInput = document.getElementById("fecha-inicio");
    const fechaFinInput = document.getElementById("fecha-fin");
    const categoriaSelect = document.getElementById("categoria");
    const cursosTable = document.querySelector(".table tbody");
    const nivelesTable = document.querySelectorAll(".table")[1].querySelector("tbody");

    function filtrarTablas() {
        const estadoSeleccionado = estadoSelect.value;
        const progresoSeleccionado = progresoSelect.value;
        const fechaInicio = fechaInicioInput.value ? new Date(fechaInicioInput.value) : null;
        const fechaFin = fechaFinInput.value ? new Date(fechaFinInput.value) : null;
        const categoriaIdSeleccionada = categoriaSelect.value;

        const cursosVisibles = [];

        const cursoFilas = cursosTable.querySelectorAll("tr");

        cursoFilas.forEach((fila) => {
            const estadoCelda = fila.querySelector("td:nth-child(2)");
            const progresoCelda = fila.querySelector("td:nth-child(5)");
            const fechaCreacionCelda = fila.querySelector("td:nth-child(3)");
            const categoriaCelda = fila.getAttribute('data-id'); // Asumimos que el curso tiene un atributo 'data-categoria-id'
            const cursoNombre = fila.querySelector("td:nth-child(1)").textContent.trim();

            const cumpleEstado =
                estadoSeleccionado === "todos" ||
                estadoCelda.textContent.toLowerCase() === estadoSeleccionado.toLowerCase();

            const cumpleProgreso =
                progresoSeleccionado === "todos" ||
                progresoEsTerminado(progresoCelda.textContent.trim());

            const cumpleFecha = cumpleRangoFecha(
                fechaCreacionCelda.textContent.trim(),
                fechaInicio,
                fechaFin
            );

            const cumpleCategoria =
                categoriaIdSeleccionada === "todas" ||
                categoriaIdSeleccionada === categoriaCelda;

            if (cumpleEstado && cumpleProgreso && cumpleFecha && cumpleCategoria) {
                fila.style.display = ""; // Mostrar la fila
                cursosVisibles.push(cursoNombre); // Agregar nombre del curso al array
            } else {
                fila.style.display = "none"; // Ocultar la fila
            }
        });

        actualizarNiveles(cursosVisibles);
    }

    function progresoEsTerminado(progreso) {
        if (progreso.toLowerCase() === "incompleto") {
            return false;
        }
        const fechaHoraRegex = /^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/;
        return fechaHoraRegex.test(progreso);
    }

    function cumpleRangoFecha(fechaTexto, fechaInicio, fechaFin) {
        const fechaRegex = /^\d{4}-\d{2}-\d{2} \d{2}:\d{2}:\d{2}$/;
        if (!fechaRegex.test(fechaTexto)) return false;

        const fecha = new Date(fechaTexto.split(" ")[0]);

        if (fechaInicio && fecha < fechaInicio) return false;
        if (fechaFin && fecha > fechaFin) return false;

        return true;
    }

    function actualizarNiveles(cursosVisibles) {
        const nivelFilas = nivelesTable.querySelectorAll("tr");

        nivelFilas.forEach((fila) => {
            const nivelCursoNombre = fila.querySelector("td:nth-child(1)").textContent.trim();

            if (cursosVisibles.includes(nivelCursoNombre)) {
                fila.style.display = "";
            } else {
                fila.style.display = "none";
            }
        });
    }

    // Agregar los eventos de los filtros
    estadoSelect.addEventListener("change", filtrarTablas);
    progresoSelect.addEventListener("change", filtrarTablas);
    fechaInicioInput.addEventListener("change", filtrarTablas);
    fechaFinInput.addEventListener("change", filtrarTablas);
    categoriaSelect.addEventListener("change", filtrarTablas);
});
