<?php
// Establecer el tipo de contenido a JSON
header('Content-Type: application/json');

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

// Verificar si se envió el nombre del alumno
if (!isset($_GET['Nombre_Alumno'])) {
    echo json_encode(['error' => 'El nombre del alumno es obligatorio.']);
    exit();
}

$nombre = trim($_GET['Nombre_Alumno']);
if ($nombre === '') {
    echo json_encode(['error' => 'El nombre del alumno no puede estar vacío.']);
    exit();
}

try {
    // Consulta para buscar al alumno aplicando collation a la columna
    $stmt = $pdo->prepare('SELECT id_alumno, Nombre_A FROM alumnos WHERE Nombre_A COLLATE utf8mb4_general_ci = :nombre');
    $stmt->execute(['nombre' => $nombre]);
    $alumno = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($alumno) {
        // Respuesta con los datos del alumno
        echo json_encode(['success' => true, 'data' => $alumno]);
    } else {
        // Si no se encuentra el alumno
        echo json_encode(['success' => false, 'message' => 'Alumno no encontrado.']);
    }
} catch (PDOException $e) {
    echo json_encode(['error' => 'Error al realizar la consulta: ' . $e->getMessage()]);
}
?>