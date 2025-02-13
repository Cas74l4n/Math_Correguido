<?php
// Conexión a la base de datos
include 'conexion/conexion.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error de conexión: ' . $e->getMessage()]);
    exit();
}

// Verificar si el método de solicitud es GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(['error' => 'Método no permitido.']);
    exit();
}

// Verificar si se envió el nombre de la actividad
if (!isset($_GET['nombreActividad'])) {
    echo json_encode(['error' => 'El nombre de la actividad es obligatorio.']);
    exit();
}

$nombreActividad = $_GET['nombreActividad'];

try {
    // Consulta para obtener las preguntas asociadas a la actividad
    $stmt = $pdo->prepare('
        SELECT 
            act.Nombre AS Nombre_Actividad,
            p.Pregunta AS Pregunta
        FROM actividad act
        JOIN pregunta p ON act.Id_Actividad = p.Id_Actividad
        WHERE act.Nombre = :nombreActividad
    ');
    $stmt->execute(['nombreActividad' => $nombreActividad]);
    $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($resultados) {
        // Respuesta con los datos de la actividad y sus preguntas
        echo json_encode(['success' => true, 'data' => $resultados]);
    } else {
        // Si no se encuentran preguntas para la actividad
        echo json_encode(['success' => false, 'message' => 'No se encontraron preguntas para esta actividad.']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error al realizar la consulta: ' . $e->getMessage()]);
}
?>
