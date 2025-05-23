<?php
$conexion = new mysqli("localhost", "root", "", "bufete2");
$conexion->set_charset("utf8");

$resultado = $conexion->query("SELECT * FROM clientes");
$clientes = [];

while ($fila = $resultado->fetch_assoc()) {
    $clientes[] = $fila;
}

echo json_encode($clientes);
?>
