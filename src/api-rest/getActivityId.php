<?php
header('Content-Type: application/json');
include 'conexion/conexion.php';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error de conexión: ' . $e->getMessage()]);
    exit();
}


if ($_SERVER['REQUEST_METHOD'] !== 'GET') {
    echo json_encode(['error' => 'Método no permitido.']);
    exit();
}

if (!isset($_GET['nombre'])) {
    echo json_encode(['error' => 'El nombre de la actividad es obligatorio.']);
    exit();
}

$nombreActividad = trim($_GET['nombre']);

try {
    $stmt = $pdo->prepare('
    SELECT 
        id_actividad 
    FROM actividad 
    WHERE nombre = :nombre
    ');
    $stmt->execute(['nombre' => $nombreActividad]);
    $actividad = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($actividad) {
        echo json_encode(['success' => true, 'data' => $actividad]);
    } else {
        echo json_encode(['success' => false, 'message' => 'Actividad no encontrada.']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error al realizar la consulta: ' . $e->getMessage()]);
}
?>
