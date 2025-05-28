<?php
require 'conexion.php';

$nombre = trim($_POST['nombre'] ?? '');
$contacto = trim($_POST['contacto'] ?? '');
$producto = trim($_POST['producto'] ?? '');

if (!$nombre || !$contacto || !$producto) {
    echo "Error: Campos incompletos.";
    exit;
}

$stmt = $conexion->prepare("INSERT INTO proveedores (nombre, contacto, producto) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $nombre, $contacto, $producto);

if ($stmt->execute()) {
    echo "Proveedor agregado correctamente.";
} else {
    echo "Error al agregar proveedor.";
}

$stmt->close();
$conexion->close();
?>
