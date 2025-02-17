<?php
header('Content-Type: application/json');

// Incluir archivo de conexión
include 'conexion/conexion.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error de conexión: ' . $e->getMessage()]);
    exit();
}

// Verificar que se utiliza el método GET
if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(['error' => 'Método no permitido.']);
    exit();
}

// Verificar que se reciba el parámetro actividad_id
if (!isset($_GET['actividad_id'])) {
    echo json_encode(['error' => 'El identificador de la actividad es obligatorio.']);
    exit();
}

$actividad_id = intval($_GET['actividad_id']);

try {
    // Consulta con JOIN para obtener preguntas y nombre de la actividad
    $stmt = $pdo->prepare("
        SELECT 
            p.id_pregunta,
            p.tiempo,
            p.pregunta,
            p.opcionA,
            p.opcionB,
            p.opcionC,
            p.opcionD,
            a.nombre AS nombre_actividad
        FROM pregunta p
        INNER JOIN actividad a ON p.id_actividad = a.id_actividad
        WHERE p.id_actividad = :actividad_id
    ");
    
    $stmt->execute(['actividad_id' => $actividad_id]);
    
    $preguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if ($preguntas) {
        echo json_encode([
            'success' => true, 
            'data' => $preguntas]
        );
    } else {
        echo json_encode(['success' => false, 'message' => 'No se encontraron preguntas para esta actividad.']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error al realizar la consulta: ' . $e->getMessage()]);
}
?>
