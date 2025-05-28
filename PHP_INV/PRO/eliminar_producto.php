<?php
require 'conexion.php';

$id = intval($_POST['id'] ?? 0);

if ($id < 1) {
    echo "Error: ID inválido.";
    exit;
}

$stmt = $conexion->prepare("DELETE FROM inventario WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Producto eliminado correctamente.";
} else {
    echo "Error al eliminar producto.";
}

$stmt->close();
$conexion->close();
?>
