    <?php
    // Configuración de la base de datos
    include 'conexion/conexion.php';

    // Conexión a la base de datos
    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error de conexión: ' . $e->getMessage()]);
        exit();
    }

    // Verificar si el método de solicitud es POST
    if ($_SERVER['REQUEST_METHOD'] !== 'GET') { /* Revisar si en postman esta bien */
        echo json_encode(['error' => 'Metodo no permitido.']);
        exit();
    }

    // Verificar si se envió el nombre del alumno
    if (!isset($_GET['Nombre_Al'])) {
        echo json_encode(['error' => 'El nombre del alumno es obligatorio.']);
        exit();
    }

    $nombreAlumno = $_GET['Nombre_Al'];

    try {
        // Consulta para obtener el equipo y profesor del alumno
        $stmt = $pdo->prepare("
            SELECT 
                eq.Id_Equipo AS Id_Equipo,
                eq.Nombre AS Nombre_Equipo,
                pr.Nombre AS Nombre_Profesor,
                (
                    SELECT GROUP_CONCAT(DISTINCT a.Nombre_A SEPARATOR ', ')
                    FROM equipo_alumno ea2
                    JOIN alumnos a ON ea2.Id_Alumno = a.id_alumno
                    WHERE ea2.Id_Equipo = eq.Id_Equipo
                ) AS Participantes,
                GROUP_CONCAT(DISTINCT act.Nombre SEPARATOR ', ') AS Actividades
            FROM equipo_alumno ea
            JOIN equipos eq ON ea.Id_Equipo = eq.Id_Equipo
            JOIN profesores pr ON eq.Id_Profesor = pr.Id_Profesor
            JOIN alumnos al ON ea.Id_Alumno = al.id_alumno
            LEFT JOIN actividad act ON eq.Id_Profesor = act.Id_Profesor
            WHERE al.Nombre_A = :nombreAlumno
            GROUP BY eq.Id_Equipo, eq.Nombre, pr.Nombre
        ");
        $stmt->execute(['nombreAlumno' => $nombreAlumno]);

        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($resultado) {
            echo json_encode([
                'success' => true,
                'data' => [
                    'Id_Equipo' => $resultado['Id_Equipo'],
                    'Nombre_Equipo' => $resultado['Nombre_Equipo'],
                    'Nombre_Profesor' => $resultado['Nombre_Profesor'],
                    'Participantes' => $resultado['Participantes'],
                    'Actividades' => $resultado['Actividades']
                ]
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se encontraron datos para el alumno especificado.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['error' => 'Error al realizar la consulta: ' . $e->getMessage()]);
    }
    ?>
