document.addEventListener("DOMContentLoaded", () => {
    const courseLinks = document.querySelectorAll(".curse-btn");

    courseLinks.forEach(link => {
        link.addEventListener("click", e => {            
            const courseId = e.target.getAttribute("id");
            localStorage.setItem("idCurso", courseId);
            window.location.href = "detallesCurso.php";
        });
    });
});