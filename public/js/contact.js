

    document.addEventListener('DOMContentLoaded', function () {
        var createContactButton = document.getElementById('create-contact');
        var contactModal = document.getElementById('contact-modal');
        var closeModal = document.querySelector('.close');
        var formMethodField = document.getElementById('form-method');

        createContactButton.addEventListener('click', function () {
            document.getElementById('modal-title').textContent = "Create Contact";
            document.getElementById('contact-form').reset();
            document.getElementById('code').value = "";
            formMethodField.value = 'POST'; // Restablecer a POST
            document.getElementById('contact-form').action = "{{ route('contacts.store') }}";
            contactModal.style.display = 'block';
        });

        closeModal.addEventListener('click', function () {
            contactModal.style.display = 'none';
        });

        window.addEventListener('click', function (event) {
            if (event.target == contactModal) {
                contactModal.style.display = 'none';
            }
        });

        document.querySelectorAll('.edit-contact').forEach(function (editButton) {
            editButton.addEventListener('click', function () {
                var contactId = this.getAttribute('data-id');

                fetch(`/contacts/${contactId}/edit`)
                    .then(response => response.json())
                    .then(data => {
                        document.getElementById('modal-title').textContent = "Edit Contact";
                        document.getElementById('contact-id').value = data.id;
                        document.getElementById('code').value = data.code;
                        document.getElementById('name').value = data.name;
                        document.getElementById('type').value = data.type;
                        document.getElementById('ruc').value = data.ruc;
                        document.getElementById('phone').value = data.phone;
                        document.getElementById('email').value = data.email;
                        formMethodField.value = 'PUT'; // Cambiar a PUT
                        document.getElementById('contact-form').action = `/contacts/${contactId}`;
                        contactModal.style.display = 'block';
                    });
            });
        });
    });
