document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('turnoForm');

    form.addEventListener('submit', function (event) {
        event.preventDefault();
        let isValid = true;

        // Clear previous errors
        document.querySelectorAll('.error').forEach(error => {
            error.textContent = '';
            if (error.previousSibling && error.previousSibling.tagName === 'BR') {
                error.previousSibling.remove();
            }
            if (error.nextSibling && error.nextSibling.tagName === 'BR') {
                error.nextSibling.remove();
            }
        });

        // Validate Cédula
        const cedula = document.getElementById('cedula');
        const cedulaError = document.getElementById('cedulaError');
        const cedulaRegex = /^\d+$/;
        if (!cedulaRegex.test(cedula.value)) {
            cedulaError.insertAdjacentHTML('beforebegin', '<br>');
            cedulaError.textContent = 'La cédula solo puede contener números.';
            isValid = false;
        }

        // Validate Nombre de Usuario
        const username = document.getElementById('username');
        const usernameError = document.getElementById('usernameError');
        const usernameRegex = /^[a-zA-Z\s]+$/;
        if (!usernameRegex.test(username.value)) {
            usernameError.insertAdjacentHTML('beforebegin', '<br>');
            usernameError.textContent = 'El nombre de usuario solo puede contener letras.';
            isValid = false;
        }

        // Validate Email
        const email = document.getElementById('email');
        const emailError = document.getElementById('emailError');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (!emailRegex.test(email.value)) {
            emailError.insertAdjacentHTML('beforebegin', '<br>');
            emailError.textContent = 'Por favor, introduce un email válido.';
            isValid = false;
        }



        if (isValid) {
            form.submit();
        }
    });

});
