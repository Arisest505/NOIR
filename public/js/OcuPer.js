document.addEventListener('DOMContentLoaded', function () {
    const toggleSwitch = document.getElementById('toggleSwitch');
    const pageTitle = document.getElementById('pageTitle');
    const openModalButton = document.getElementById('openModalButton');
    const occupationTable = document.getElementById('occupationTable');
    const permissionTable = document.getElementById('permissionTable');
    const createOccupationModal = document.getElementById('createOccupationModal');
    const createPermissionModal = document.getElementById('createPermissionModal');
    const closeModalButtons = document.querySelectorAll('.modal .close');
    const createOccupationForm = document.getElementById('createOccupationForm');
    const createPermissionForm = document.getElementById('createPermissionForm');
    const occupationTableBody = document.getElementById('occupationTableBody');
    const permissionTableBody = document.getElementById('permissionTableBody');

    // Handle permission name preview
    const namePermissionInput = document.getElementById('name_permission');
    if (namePermissionInput) {
        const namePreview = document.createElement('p');
        namePreview.style.fontStyle = 'italic';
        namePermissionInput.parentNode.insertBefore(namePreview, namePermissionInput.nextSibling);

        namePermissionInput.addEventListener('input', function() {
            const permissionName = 'manage_' + namePermissionInput.value;
            namePreview.textContent = `Nombre del permiso completo: ${permissionName}`;
        });
    }

    // Function to update the title, button text, and table visibility based on the switch state
    function updateContent() {
        if (toggleSwitch.checked) {
            pageTitle.textContent = 'Ocupacion';
            openModalButton.textContent = 'Crear Nuevo Ocupacion';
            occupationTable.style.display = 'block';
            permissionTable.style.display = 'none';
            createPermissionModal.style.display = 'none';
        } else {
            pageTitle.textContent = 'Permisos';
            openModalButton.textContent = 'Crear Nuevo Permiso';
            occupationTable.style.display = 'none';
            permissionTable.style.display = 'block';
            createOccupationModal.style.display = 'none';
        }
    }

    // Add event listener to the switch
    toggleSwitch.addEventListener('change', updateContent);

    // Show the appropriate modal when the button is clicked
    openModalButton.addEventListener('click', function() {
        if (toggleSwitch.checked) {
            createOccupationModal.style.display = 'block';
        } else {
            createPermissionModal.style.display = 'block';
        }
    });

    // Close the modals when the close button is clicked
    closeModalButtons.forEach(button => {
        button.addEventListener('click', function() {
            createOccupationModal.style.display = 'none';
            createPermissionModal.style.display = 'none';
        });
    });

    // Handle the form submission for occupation via AJAX
    createOccupationForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(createOccupationForm);

        fetch('/recursoshumanos/ocuper', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Add the new occupation to the table
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${data.occupation.occupation_id}</td>
                    <td>${data.occupation.name_occupation}</td>
                    <td><button class="btn-delete" data-id="${data.occupation.occupation_id}">Eliminar</button></td>
                `;
                occupationTableBody.appendChild(newRow);

                // Attach the delete event listener to the new button
                attachDeleteEvent(newRow.querySelector('.btn-delete'));

                // Close the modal
                createOccupationModal.style.display = 'none';

                // Clear the form
                createOccupationForm.reset();
            } else {
                alert('Hubo un error al guardar la ocupación.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    // Handle the form submission for permission via AJAX
    createPermissionForm.addEventListener('submit', function(e) {
        e.preventDefault();

        const formData = new FormData(createPermissionForm);

        fetch('/recursoshumanos/permisos', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Add the new permission to the table
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${data.permission.permission_id}</td>
                    <td>${data.permission.name}</td>
                    <td><button class="btn-delete-permission" data-id="${data.permission.permission_id}">Eliminar</button></td>
                `;
                permissionTableBody.appendChild(newRow);

                // Attach the delete event listener to the new button
                attachDeletePermissionEvent(newRow.querySelector('.btn-delete-permission'));

                // Close the modal
                createPermissionModal.style.display = 'none';

                // Clear the form
                createPermissionForm.reset();
            } else {
                alert('Hubo un error al guardar el permiso.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });

    // Function to handle the delete button click for occupations via AJAX
    function attachDeleteEvent(button) {
        button.addEventListener('click', function() {
            const occupationId = this.dataset.id;

            if (confirm('¿Estás seguro de que deseas eliminar esta ocupación?')) {
                fetch(`/recursoshumanos/ocuper/${occupationId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the row from the table
                        this.closest('tr').remove();
                    } else {
                        alert('Hubo un error al eliminar la ocupación.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    }

    // Function to handle the delete button click for permissions via AJAX
    function attachDeletePermissionEvent(button) {
        button.addEventListener('click', function() {
            const permissionId = this.dataset.id;

            if (confirm('¿Estás seguro de que deseas eliminar este permiso?')) {
                fetch(`/recursoshumanos/permisos/${permissionId}`, {
                    method: 'DELETE',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Remove the row from the table
                        this.closest('tr').remove();
                    } else {
                        alert('Hubo un error al eliminar el permiso.');
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                });
            }
        });
    }

    // Attach delete event listeners to all existing delete buttons
    document.querySelectorAll('.btn-delete').forEach(button => {
        attachDeleteEvent(button);
    });

    document.querySelectorAll('.btn-delete-permission').forEach(button => {
        attachDeletePermissionEvent(button);
    });

    // Initial call to set the correct text and table on page load
    updateContent();
});
