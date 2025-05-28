<?php
require 'conexion.php';

$id = intval($_POST['id'] ?? 0);

if ($id < 1) {
    echo "Error: ID inválido.";
    exit;
}

$stmt = $conexion->prepare("DELETE FROM proveedores WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Proveedor eliminado correctamente.";
} else {
    echo "Error al eliminar proveedor.";
}

$stmt->close();
$conexion->close();
?>
