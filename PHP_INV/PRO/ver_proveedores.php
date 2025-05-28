<?php
require 'conexion.php';

$result = $conexion->query("SELECT id, nombre, contacto, producto FROM proveedores ORDER BY id DESC");

$proveedores = [];

while ($row = $result->fetch_assoc()) {
    $proveedores[] = $row;
}

header('Content-Type: application/json');
echo json_encode($proveedores);

$conexion->close();
?>
