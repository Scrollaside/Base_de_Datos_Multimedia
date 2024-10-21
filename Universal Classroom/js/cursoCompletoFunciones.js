// Funcionalidad para cambiar el video según el tema seleccionado
document.querySelectorAll('.topics li').forEach(item => {
    item.addEventListener('click', function () {
        const videoSrc = this.getAttribute('data-video');
        document.getElementById('courseVideo').setAttribute('src', videoSrc);
        document.getElementById('courseVideo').play();
    });
});