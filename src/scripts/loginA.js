document.addEventListener('DOMContentLoaded', () => {
    const form = document.querySelector('#login-form'); // Asegúrate de que el formulario tenga este id
    if (!form) return; // Evita errores si el formulario no existe

    form.addEventListener('submit', async (event) => {
        event.preventDefault(); // Evitar comportamiento por defecto del formulario.

        const nombreAlumno = document.querySelector('#team-name').value.trim();
        const messageContainer = document.querySelector('#message-container');

        // Validación simple
        if (!nombreAlumno) {
            if (messageContainer) {
                messageContainer.textContent = 'Por favor, ingresa tu nombre.';
            }
            return;
        }

        try {
            const response = await fetch(`../api-rest/loginAlumnos.php?Nombre_Alumno=${encodeURIComponent(nombreAlumno)}`, {
                method: 'GET',
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();

            if (data.success) {
                // Almacenar el nombre del alumno en localStorage
                localStorage.setItem('nombreAlumno', nombreAlumno);
                // Redirigir a la página del alumno
                window.location.href = '../pages/Alumnos/pageAlum.php'; // Asegúrate de que esta URL sea correcta.
            } else {
                if (messageContainer) {
                    messageContainer.textContent = data.message || 'Alumno no encontrado.';
                    messageContainer.style.color = 'red';
                }
            }
        } catch (error) {
            console.error(error);            
            if (messageContainer) {
                messageContainer.textContent = 'Hubo un problema al procesar la solicitud.';
                messageContainer.style.color = 'red';
            }
        }
    });
});
