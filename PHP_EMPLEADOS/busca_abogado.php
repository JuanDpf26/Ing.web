<?php
$conexion = new mysqli("localhost", "root", "", "bufete2");
$conexion->set_charset("utf8");

$id = $_GET['id'] ?? null;

if (!$id) {
    echo json_encode(['error' => 'Falta el ID']);
    exit;
}

$sql = "SELECT nombre FROM abogados WHERE id = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    echo json_encode(['nombre' => $row['nombre']]);
} else {
    echo json_encode(['nombre' => null]);
}

$stmt->close();
$conexion->close();
?>

