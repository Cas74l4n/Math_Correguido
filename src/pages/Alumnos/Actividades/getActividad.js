document.addEventListener('DOMContentLoaded', async() => {
    // Recuperar el nombre del alumno guardado
    const nombreAlumno = localStorage.getItem('nombreAlumno');
    const urlParams = new URLSearchParams(window.location.search);

    if (!nombreAlumno) {
        // Si no hay un nombre guardado, redirigir al login
        window.location.href = '../loginA.php';
        return;
    }

    // Si el alumno está logueado, puedes usar el nombre para mostrarlo en la página
    document.querySelector('.user-name').textContent = nombreAlumno;

    const actividadId = urlParams.get('actividad_id');
    console.log(actividadId);

    // Llamada a la API REST pasando el actividad_id
    fetch(`../../../api-rest/getPreguntaAlumno.php?actividad_id=${actividadId}`)
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Asumimos que la API retorna un array de preguntas, y cada registro incluye el nombre de la actividad
                const actividadInfo = data.data[0];
                // Actualizar el DOM con la información de la actividad
                document.querySelector('.activity-name').textContent = actividadInfo.nombre_actividad;

                // Por ejemplo, si quieres listar las preguntas:
                const questionsList = document.querySelector('.questions-list');
                questionsList.innerHTML = '';
                data.data.forEach(question => {
                    const li = document.createElement('li');
                    li.textContent = question.pregunta; // Puedes agregar más datos (tiempo, opciones, etc.)
                    questionsList.appendChild(li);
                });
            } else {
                console.error(data.message);
            }
        })
        .catch(error => {
            console.error('Error al conectar con la API:', error);
        });

   /*  try{
        const response = await fetch(`../../../api-rest/getActividadAlumno.php?actividad_id=${encodeURIComponent(nombreAlumno)}`, {
            method: 'GET',
        });
        
        if (!response.ok) throw new Error('Error al conectar con el servidor.');

        // Parsear la respuesta JSON
        const data = await response.json();
        if(data.success){
            const{id_pregunta, tiempo, pregunta, opccionA, opccionB, opccionC, opccionD, nombre_actividad} = data.data;
            document.querySelector('.timer').textContent = tiempo;
            document.querySelector('.question-text').textContent = pregunta;
            document.querySelector('#optionA').textContent = opccionA;
            document.querySelector('#optionB').textContent = opccionB;
            document.querySelector('#optionC').textContent = opccionC;
            document.querySelector('#optionD').textContent = opccionD;
            document.querySelector('.activity-name').textContent = nombre_actividad;
        }
        else {
            alert(data.message || 'No se encontraron datos.');
        }

    }catch(error){
        console.error('Error al cargar los datos:', error);
        alert('Hubo un problema al cargar los datos. Intenta nuevamente más tarde.');
    } */
});
