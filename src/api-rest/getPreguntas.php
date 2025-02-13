<?php
include 'conexion/conexion.php';
// Conexión a la base de datos
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error de conexión: ' . $e->getMessage()]);
    exit();
}

// Obtener el nombre del profesor desde el parámetro GET
if (!isset($_GET['profesor'])) {
    echo json_encode(['error' => 'El nombre del profesor es requerido.']);
    exit();
}

$profesor = $_GET['profesor'];

try {
    // Consulta SQL para obtener las preguntas asociadas al profesor
    $stmt = $pdo->prepare("
        SELECT p.Id_Pregunta, p.Tiempo, p.Pregunta, a.Nombre AS actividad
        FROM pregunta p
        JOIN actividad a ON p.Id_Actividad = a.Id_Actividad
        JOIN profesores pr ON a.Id_Profesor = pr.Id_Profesor
        WHERE pr.Nombre = :profesor
    ");
    $stmt->execute(['profesor' => $profesor]);
    $preguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los resultados en formato JSON
    echo json_encode($preguntas);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error al realizar la consulta: ' . $e->getMessage()]);
}
?>

