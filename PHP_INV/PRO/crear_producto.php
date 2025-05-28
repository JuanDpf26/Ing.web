<?php
require 'conexion.php';

$nombre = trim($_POST['nombre'] ?? '');
$categoria = trim($_POST['categoria'] ?? '');
$cantidad = intval($_POST['cantidad'] ?? 0);
$fecha = $_POST['fecha'] ?? '';

if (!$nombre || !$categoria || $cantidad < 1 || !$fecha) {
    echo "<script>alert('Error: Campos incompletos o inválidos.'); window.history.back();</script>";
    exit;
}

$stmt = $conexion->prepare("INSERT INTO inventario (nombre, categoria, cantidad, fecha) VALUES (?, ?, ?, ?)");
$stmt->bind_param("ssis", $nombre, $categoria, $cantidad, $fecha);

if ($stmt->execute()) {
    echo "Proveedor agregado correctamente.";
} else {
    echo "Error al agregar proveedor.";
}

$stmt->close();
$conexion->close();
?>
