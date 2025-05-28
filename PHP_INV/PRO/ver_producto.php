<?php
require 'conexion.php';

$result = $conexion->query("SELECT id, nombre, categoria, cantidad, fecha FROM inventario ORDER BY id DESC");

$productos = [];

while ($row = $result->fetch_assoc()) {
    $productos[] = $row;
}

header('Content-Type: application/json');
echo json_encode($productos);

$conexion->close();
?>
