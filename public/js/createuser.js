document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('createUserForm');
    const staffForm = document.getElementById('staffDetailsForm');
    const errorDiv = document.getElementById('formError');
    const openModalButton = document.getElementById('openModalButton');
    const closeModalButton = document.getElementById('closeModalButton');
    const userModal = document.getElementById('userModal');
    const userTableBody = document.getElementById('userTableBody');
    const createUserTab = document.getElementById('createUserTab');
    const staffDetailsTab = document.getElementById('staffDetailsTab');
    const createUserContent = document.getElementById('createUserContent');
    const staffDetailsContent = document.getElementById('staffDetailsContent');
    const staffSelect = document.getElementById('id_staff_user'); // El menú desplegable de staff

    // Función para abrir el modal
    function openModal() {
        userModal.style.display = 'block';
    }

    // Función para cerrar el modal
    function closeModal() {
        userModal.style.display = 'none';
    }

    // Manejar el clic en el botón para abrir el modal
    openModalButton.addEventListener('click', openModal);

    // Manejar el clic en el botón para cerrar el modal
    closeModalButton.addEventListener('click', closeModal);

    // Cambio de pestañas en el modal
    createUserTab.addEventListener('click', function (e) {
        e.preventDefault();
        createUserTab.classList.add('active');
        staffDetailsTab.classList.remove('active');
        createUserContent.classList.add('active');
        staffDetailsContent.classList.remove('active');
    });

    staffDetailsTab.addEventListener('click', function (e) {
        e.preventDefault();
        staffDetailsTab.classList.add('active');
        createUserTab.classList.remove('active');
        staffDetailsContent.classList.add('active');
        createUserContent.classList.remove('active');
    });

    // Manejar el envío del formulario de usuario
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(form);

        fetch(storeUrl, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert(data.success);
                form.reset();
                closeModal(); 
                errorDiv.innerHTML = '';

                // Agregar el nuevo usuario a la tabla
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${data.user.name}</td>
                    <td>${data.user.email}</td>
                    <td>${data.user.staff.name_staff} ${data.user.staff.apat_staff}</td>
                    <td><button class="btn btn-info access-button" data-id="${data.user.user_id}">Brindar Accesos</button></td>
                `;

                userTableBody.appendChild(newRow);

                // Reasignar el evento click a los nuevos botones
                addAccessButtonEvents();
            } else if (data.error) {
                errorDiv.innerHTML = `<p>${data.error}</p>`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            errorDiv.innerHTML = '<p>Hubo un error al procesar la solicitud. Inténtalo de nuevo más tarde.</p>';
        });
    });

    // Manejar el envío del formulario de personal
    staffForm.addEventListener('submit', function (event) {
        event.preventDefault();
        const formData = new FormData(staffForm);

        fetch(storeStaffUrl, {
            method: 'POST',
            body: formData,
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
        })
        .then(response => response.json().then(data => ({status: response.status, body: data})))
        .then(data => {
            if (data.status === 200) {
                alert(data.body.success);
                staffForm.reset();
                errorDiv.innerHTML = '';

                // Actualizar el menú desplegable de staff
                updateStaffDropdown(data.body.staffList);

            } else if (data.status === 422) {
                // Mostrar los errores de validación en el frontend
                let errorMessages = '<strong>Errores de validación:</strong><ul>';
                for (const [field, messages] of Object.entries(data.body.errors)) {
                    errorMessages += `<li><strong>${field}:</strong> ${messages.join(', ')}</li>`;
                }
                errorMessages += '</ul>';
                errorDiv.innerHTML = errorMessages;
            } else {
                errorDiv.innerHTML = `<p>Ocurrió un error inesperado. Inténtalo de nuevo más tarde.</p>`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
            errorDiv.innerHTML = '<p>Hubo un error al procesar la solicitud. Inténtalo de nuevo más tarde.</p>';
        });
    });

    // Función para actualizar el menú desplegable de staff
    function updateStaffDropdown(staffList) {
        // Vaciar el menú actual
        staffSelect.innerHTML = '<option value="" disabled selected>Seleccionar Personal</option>';

        // Llenar con los nuevos datos
        staffList.forEach(function(staffMember) {
            const option = document.createElement('option');
            option.value = staffMember.staff_id;
            option.textContent = `${staffMember.name_staff} ${staffMember.apat_staff}`;
            staffSelect.appendChild(option);
        });
    }

    // Función para agregar eventos a los botones "Brindar Accesos"
    function addAccessButtonEvents() {
        const accessButtons = document.querySelectorAll('.access-button');

        accessButtons.forEach(button => {
            button.addEventListener('click', function () {
                // Obtener el id del usuario desde el atributo data-id
                const userId = this.getAttribute('data-id');
                
                // Redirigir a la nueva vista con el id del usuario
                window.location.href = `/recursoshumanos/accesouser/${userId}`;
            });
        });
    }

    // Agregar eventos a los botones existentes al cargar la página
    addAccessButtonEvents();

    // Cerrar el modal si se hace clic fuera del modal
    window.addEventListener('click', function (event) {
        if (event.target === userModal) {
            closeModal();
        }
    });
});
