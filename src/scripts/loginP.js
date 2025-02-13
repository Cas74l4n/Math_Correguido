document.addEventListener('DOMContentLoaded', () => {
    document.querySelector('form').addEventListener('submit', async (event) => {
        event.preventDefault(); // Evitar comportamiento por defecto del formulario.
        const nombreAlumno = document.querySelector('#team-name').value;

        try {
            const response = await fetch(`../api-rest/loginProfesor.php?Nombre_Alumno=${encodeURIComponent(nombreAlumno)}`, {
                method: 'GET',
            });

            if (!response.ok) {
                throw new Error(`HTTP error! status: ${response.status}`);
            }

            const data = await response.json();

            if (data.success) {
                // Si se encuentra el Profe, redirige automáticamente.
                window.location.href = '../pages/Profe/PageProf.php'; // Asegúrate de que esta URL sea correcta.
            } else {
                // Muestra un mensaje en el DOM, no como alerta.
                const messageContainer = document.querySelector('#message-container') || document.createElement('div');
                messageContainer.id = 'message-container';
                messageContainer.textContent = data.message || 'Profe no encontrado.';
                messageContainer.style.color = 'red';
                document.body.appendChild(messageContainer);
            }
        } catch (error) {
            console.error(error);
            const errorContainer = document.querySelector('#error-container') || document.createElement('div');
            errorContainer.id = 'error-container';
            errorContainer.textContent = 'Hubo un problema al procesar la solicitud.';
            errorContainer.style.color = 'red';
            document.body.appendChild(errorContainer);
        }
    });
});


