document.addEventListener('DOMContentLoaded', async() => {
    // Recuperar el nombre del alumno guardado
    const nombreAlumno = localStorage.getItem('nombreAlumno');
    const urlParams = new URLSearchParams(window.location.search);

    if (!nombreAlumno) {
        // Si no hay un nombre guardado, redirigir al login
        window.location.href = '../loginA.php';
        return;
    }
        // Intentar obtener el ID de la actividad de la URL
        let actividadId = urlParams.get('actividad_id');
        const nombreActividad = urlParams.get('nombre'); // Si viene solo el nombre
    
        // Si no se obtuvo actividad_id y viene el nombre, llamar a la API para convertirlo a ID
        if (!actividadId && nombreActividad) {
            try {
                const response = await fetch(`../../../api-rest/getActivityId.php?nombre=${encodeURIComponent(nombreActividad)}`);
                const result = await response.json();
                if (result.success) {
                    actividadId = result.data.id_actividad;
                } else {
                    console.error(result.message);
                    return;
                }
            } catch (error) {
                console.error('Error al obtener el id de la actividad:', error);
                return;
            }
        }
    
        // Si aún no se tiene un ID, mostrar error
        if (!actividadId) {
            console.error('No se ha proporcionado un id de actividad ni un nombre válido.');
            return;
        }

        // Llamada a la API REST que obtiene las preguntas usando el actividad_id
        fetch(`../../../api-rest/getPreguntaAlumno.php?actividad_id=${actividadId}`)
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Suponemos que la API retorna un array de preguntas, y cada registro incluye el nombre de la actividad
                    const actividadInfo = data.data[0];
                    // Actualizar el DOM con la información de la actividad
                    document.querySelector('.activity-title').textContent = actividadInfo.nombre_actividad;
    
                    // Mostrar la lista de preguntas
                    const questionsList = document.querySelector('.questions-list');
                    questionsList.innerHTML = '';
                    data.data.forEach(question => {
                        const li = document.createElement('li');
                        li.textContent = question.pregunta;
                        questionsList.appendChild(li);
                    });
                    // Mostrar la lista de preguntas
                    const time = document.querySelector('.timer');
                    time.innerHTML = '';
                    data.data.forEach(question => {
                        const span = document.createElement('span');
                        span.textContent = question.tiempo;
                        time.appendChild(span);
                    });
                    // Mostrar la lista de preguntas
                    const opccion_a = document.querySelector('#opccionA');
                    opccion_a.innerHTML = '';
                    data.data.forEach(question => {
                        const span = document.createElement('span');
                        span.textContent = question.opcionA;
                        opccion_a.appendChild(span);
                    });
                    // Mostrar la lista de preguntas
                    const opccion_b = document.querySelector('#opccionB');
                    opccion_b.innerHTML = '';
                    data.data.forEach(question => {
                        const span = document.createElement('span');
                        span.textContent = question.opcionB;
                        opccion_b.appendChild(span);
                    });
                    // Mostrar la lista de preguntas
                    const opccion_c = document.querySelector('#opccionC');
                    opccion_c.innerHTML = '';
                    data.data.forEach(question => {
                        const span = document.createElement('span');
                        span.textContent = question.opcionC;
                        opccion_c.appendChild(span);
                    });
                    // Mostrar la lista de preguntas
                    const opccion_d = document.querySelector('#opccionD');
                    opccion_d.innerHTML = '';
                    data.data.forEach(question => {
                        const span = document.createElement('span');
                        span.textContent = question.opcionD;
                        opccion_d.appendChild(span);
                    });
                } else {
                    console.error(data.message);
                }
            })
            .catch(error => {
                console.error('Error al conectar con la API:', error);
            });

   /*  try{
        const response = await fetch(`../../../api-rest/getPreguntaAlumno.php?actividad_id=${encodeURIComponent(nombreAlumno)}`, {
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
