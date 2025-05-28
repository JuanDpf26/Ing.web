<?php
require 'conexion.php';

$id = intval($_POST['id'] ?? 0);
$nombre = trim($_POST['nombre'] ?? '');
$categoria = trim($_POST['categoria'] ?? '');
$cantidad = intval($_POST['cantidad'] ?? 0);
$fecha = $_POST['fecha'] ?? '';

if ($id < 1 || !$nombre || !$categoria || $cantidad < 1 || !$fecha) {
    echo "Error: Datos inválidos para actualización.";
    exit;
}

$stmt = $conexion->prepare("UPDATE inventario SET nombre=?, categoria=?, cantidad=?, fecha=? WHERE id=?");
$stmt->bind_param("ssisi", $nombre, $categoria, $cantidad, $fecha, $id);

if ($stmt->execute()) {
    echo "Producto actualizado correctamente.";
} else {
    echo "Error al actualizar producto.";
}

$stmt->close();
$conexion->close();
?>
