document.addEventListener("DOMContentLoaded", function() {
    var messagesContainer = document.querySelector(".messages");

    // Scroll inicial al cargar la página
    messagesContainer.scrollTop = messagesContainer.scrollHeight;

    // Desplazamiento suave al enviar un nuevo mensaje
    var form = document.querySelector('.send-message-form');
    form.addEventListener('submit', function() {
        setTimeout(function() {
            messagesContainer.scroll({
                top: messagesContainer.scrollHeight,
                behavior: 'smooth' // Desplazamiento suave
            });
        }, 100); // Puedes ajustar el tiempo aquí si es necesario
    });
});