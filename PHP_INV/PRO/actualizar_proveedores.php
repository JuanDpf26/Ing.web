<?php
require 'conexion.php';

$id = intval($_POST['id'] ?? 0);
$nombre = trim($_POST['nombre'] ?? '');
$contacto = trim($_POST['contacto'] ?? '');
$producto = trim($_POST['producto'] ?? '');

if ($id < 1 || !$nombre || !$contacto || !$producto) {
    echo "Error: Datos inválidos para actualización.";
    exit;
}

$stmt = $conexion->prepare("UPDATE proveedores SET nombre=?, contacto=?, producto=? WHERE id=?");
$stmt->bind_param("sssi", $nombre, $contacto, $producto, $id);

if ($stmt->execute()) {
    echo "Proveedor actualizado correctamente.";
} else {
    echo "Error al actualizar proveedor.";
}

$stmt->close();
$conexion->close();
?>

