document.addEventListener('DOMContentLoaded', async () => {
    // Nombre del alumno guardado en localStorage
    const nombreAlumno = localStorage.getItem('nombreAlumno');

    if (!nombreAlumno) {
        // Si no hay un nombre guardado, redirigir al login
        window.location.href = '../loginA.php';
        return;
    }
    try {

        // URL del endpoint PHP con el parámetro 'Nombre_Al'
        const response = await fetch(`../../api-rest/QueryEquipo.php?Nombre_Al=${encodeURIComponent(nombreAlumno)}`, {
            method: 'GET',
        });

        if (!response.ok) throw new Error('Error al conectar con el servidor.');

        // Parsear la respuesta JSON
        const data = await response.json();

        // Validar si la respuesta fue exitosa
        if (data.success) {
            // Destructurar los datos
            const { Id_Equipo, Nombre_Equipo, Nombre_Profesor, Participantes, Actividades } = data.data;

            // Poblar el contenido dinámicamente
            document.querySelector('.team-name').textContent = Nombre_Equipo;
            document.querySelector('.team-role').textContent = 'Equipo # ' + Id_Equipo; // Ajustar según tu lógica
            document.querySelector('.teacher-name').textContent = Nombre_Profesor;

            // Llenar la lista de integrantes
            const membersList = document.querySelector('.members');
            membersList.innerHTML = ''; // Limpiar lista existente
            Participantes.split(', ').forEach(participante => {
                const li = document.createElement('li');
                li.textContent = participante;
                membersList.appendChild(li);
            });

            // Llenar la lista de actividades      
            const activitiesList = document.querySelector('.activities-list');
            activitiesList.innerHTML = '';
            Actividades.split(', ').forEach(actividad => {
                const li = document.createElement('li');
                li.textContent = actividad;
                li.style.cursor = 'pointer'; // Dar estilo para que parezca clicable
                li.addEventListener('click', () => { // Event listener para redirigir a la actividad
                    window.location.href = `../Alumnos/Actividades/Actividad.php?nombre=${encodeURIComponent(actividad)}`;
                });
                activitiesList.appendChild(li);
            });

        } else {
            alert(data.message || 'No se encontraron datos.');
        }
    } catch (error) {
        console.error('Error al cargar los datos:', error);
        alert('Hubo un problema al cargar los datos. Intenta nuevamente más tarde.');
    }
});