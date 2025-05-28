<?php
require 'conexion.php';

$result = $conexion->query("SELECT COUNT(*) as total FROM inventario");
$total = $result->fetch_assoc()['total'] ?? 0;

header('Content-Type: application/json');
echo json_encode(['total' => (int)$total]);

$conexion->close();
?>
