document.addEventListener('DOMContentLoaded', function() {
    var modal = document.getElementById("permissionsModal");
    var btn = document.getElementById("grantAccessButton");
    var span = document.getElementsByClassName("close")[0];
    var backButton = document.getElementById("backButton");

    // Abrir modal al hacer clic en el botón "Brindar Accesos"
    btn.onclick = function() {
        modal.style.display = "block";
    }

    // Cerrar modal al hacer clic en la "x"
    span.onclick = function() {
        modal.style.display = "none";
    }

    // Cerrar modal al hacer clic fuera del modal
    window.onclick = function(event) {
        if (event.target == modal) {
            modal.style.display = "none";
        }
    }

    // Manejo del botón "Volver"
    backButton.addEventListener('click', function() {
        window.location.href = this.getAttribute('data-back-url');
    });
});
