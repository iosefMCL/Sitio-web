// Comportamiento de la interfaz: mensajes de compra y flechas del carrusel.
document.addEventListener('DOMContentLoaded', function () {
    // Mensajes: se cierran con la X y desaparecen solos a los 6 segundos
    document.querySelectorAll('.toast').forEach(function (toast) {
        var cerrar = function () { toast.classList.add('toast--hide'); };
        toast.querySelector('.toast__close').addEventListener('click', cerrar);
        setTimeout(cerrar, 6000);
    });

    // Flechas del carrusel: desplazan una tarjeta a la vez
    var carrusel = document.getElementById('carousel');
    if (!carrusel) { return; }

    document.querySelectorAll('[data-carousel]').forEach(function (boton) {
        boton.addEventListener('click', function () {
            var tarjeta = carrusel.querySelector('.card');
            var paso = tarjeta ? tarjeta.getBoundingClientRect().width + 24 : 320;
            var direccion = boton.dataset.carousel === 'next' ? 1 : -1;
            carrusel.scrollBy({ left: paso * direccion, behavior: 'smooth' });
        });
    });
});
