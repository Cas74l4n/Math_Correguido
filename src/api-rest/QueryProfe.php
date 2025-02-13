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
if (!isset($_GET['Nombre_Profe'])) {
    echo json_encode(['error' => 'El nombre del alumno es obligatorio.']);
    exit();
}

$nombreProfesor = $_GET['Nombre_Profe'];

try {
    // Consulta para obtener el equipo y profesor del alumno
    $stmt = $pdo->prepare("
        SELECT 
            pr.Nombre AS Nombre_Profesor,
            GROUP_CONCAT(DISTINCT a.Nombre_A SEPARATOR ', ') AS Lista_Alumnos,
            GROUP_CONCAT(DISTINCT act.Nombre SEPARATOR ', ') AS Lista_Actividades,
            GROUP_CONCAT(DISTINCT eq.Nombre SEPARATOR ', ') AS Lista_Equipos
        FROM profesores pr
        LEFT JOIN equipos eq ON pr.Id_Profesor = eq.Id_Profesor
        LEFT JOIN equipo_alumno ea ON eq.Id_Equipo = ea.Id_Equipo
        LEFT JOIN alumnos a ON ea.Id_Alumno = a.id_alumno
        LEFT JOIN actividad act ON pr.Id_Profesor = act.Id_Profesor
        WHERE pr.Nombre = :nombreProfesor
        GROUP BY pr.Nombre;

    ");
    $stmt->execute(['nombreProfesor' => $nombreProfesor]);

    $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($resultado) {
        echo json_encode([
            'success' => true,
            'data' => [
                'Lista_Alumnos' => $resultado['Lista_Alumnos'],
                'Lista_Actividades' => $resultado['Lista_Actividades'],
                'Lista_Equipos' => $resultado['Lista_Equipos']            ]
        ]);
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron datos para el alumno especificado.']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error al realizar la consulta: ' . $e->getMessage()]);
}
?>
