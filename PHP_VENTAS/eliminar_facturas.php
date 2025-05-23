<?php
header('Content-Type: application/json');

// Conexión a la base de datos
$conexion = new mysqli("localhost", "root", "", "bufete2");
$conexion->set_charset("utf8");

// Verifica la conexión
if ($conexion->connect_error) {
    echo json_encode([
        'success' => false,
        'message' => 'Error de conexión: ' . $conexion->connect_error
    ]);
    exit;
}

// Verifica si se recibió el ID de la factura
$factura_id = $_POST['factura_id'] ?? null;

if (!$factura_id) {
    echo json_encode([
        'success' => false,
        'message' => 'No se recibió el ID de la factura.'
    ]);
    exit;
}

// Prepara y ejecuta la eliminación
$stmt = $conexion->prepare("DELETE FROM factura WHERE factura_id = ?");
$stmt->bind_param("i", $factura_id);

if ($stmt->execute()) {
    echo json_encode([
        'success' => true,
        'message' => 'Factura eliminada correctamente.'
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Error al eliminar: ' . $stmt->error
    ]);
}

// Cierre de recursos
$stmt->close();
$conexion->close();
?>

