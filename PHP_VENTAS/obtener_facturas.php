<?php
$conexion = new mysqli("localhost", "root", "", "bufete2");
$conexion->set_charset("utf8");

$resultado = $conexion->query("SELECT * FROM facturas");
$facturas = [];

while ($fila = $resultado->fetch_assoc()) {
    $facturas[] = $fila;
}

echo json_encode($facturas);
?>
