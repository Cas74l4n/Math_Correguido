<?php
// Configuración de la base de datos
$host = 'localhost';
$dbname = 'correct_math';
$username = 'root';
$password = '';

// Conexión a la base de datos
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error de conexión: ' . $e->getMessage()]);
    exit();
}

// Verificar parámetros requeridos
if (!isset($_GET['profesor']) || !isset($_GET['keyword'])) {
    echo json_encode(['error' => 'Se requiere el nombre del profesor y la palabra clave.']);
    exit();
}

$profesor = $_GET['profesor'];
$keyword = '%' . $_GET['keyword'] . '%'; // Para búsqueda parcial

try {
    // Consulta SQL para filtrar preguntas por palabra clave
    $stmt = $pdo->prepare("
        SELECT p.Id_Pregunta, p.Tiempo, p.Pregunta, a.Nombre AS actividad
        FROM pregunta p
        JOIN actividad a ON p.Id_Actividad = a.Id_Actividad
        JOIN Profesores pr ON a.Id_Profesor = pr.Id_Profesor
        WHERE pr.Nombre = :profesor AND p.Pregunta LIKE :keyword
    ");
    $stmt->execute(['profesor' => $profesor, 'keyword' => $keyword]);
    $preguntas = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Devolver los resultados en formato JSON
    echo json_encode($preguntas);
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error al realizar la consulta: ' . $e->getMessage()]);
}
?>
