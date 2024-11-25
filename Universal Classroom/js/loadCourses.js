document.addEventListener("DOMContentLoaded", () => {
    const courseLinks = document.querySelectorAll(".curso-link");

    courseLinks.forEach(link => {
        link.addEventListener("click", function(event) {
            event.preventDefault();
            
            const courseId = this.dataset.id;
            loadCourseDetails(courseId);
        });
    });
});

function loadCourseDetails(courseId) {
    fetch(`views/detalleCurso.php?id=${courseId}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById("course-details-container").innerHTML = data;
            window.history.pushState(null, null, `index.php?controller=detalleCurso&id=${courseId}`);
        })
        .catch(error => console.error('Error cargando los detalles del curso:', error));
}
