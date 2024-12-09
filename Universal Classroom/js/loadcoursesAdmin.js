var tipoUsuario = parseInt(localStorage.getItem("TipoUsuario"));

document.addEventListener("DOMContentLoaded", () => {
    const courseLinks = document.querySelectorAll(".boton-curso");
    const deletecourseLinks = document.querySelectorAll(".boton-curso-eliminar");
 console.log(courseLinks);
 console.log(tipoUsuario);


    courseLinks.forEach(link => {
        link.addEventListener("click", e => {             
            const courseId = e.target.getAttribute("id");
            localStorage.setItem("idCurso", courseId);
            window.location.href = "detallesCurso.php";
        });
    });

    deletecourseLinks.forEach(link => {
if (tipoUsuario!=3) {
    link.style.display="none"
    return
}
        link.addEventListener("click", e => {             
            const courseId = e.target.getAttribute("id");
           
            fetch('./Controllers/DetalleCurso.php', {
                method: "POST",
                body: JSON.stringify({ option: 5, idCurso: courseId })
            })
                
                .then (async data =>  {
                    try{
                    var succes = await data.json()                
                     
                        alert('curso borrado correctamente.');
                        location.reload()
                        }
                    catch(e){
                        alert('No puedes eliminar un curso con alumnos activos.');
                    }
                })
                .catch(error => console.error('Error al elimanar el curso ', error));
        });
    });

});
