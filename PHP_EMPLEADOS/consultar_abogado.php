<?php
$conexion = new mysqli("localhost", "root", "", "bufete2");
$conexion->set_charset("utf8");

$resultado = $conexion->query("SELECT * FROM abogados");
$abogados = [];

while ($fila = $resultado->fetch_assoc()) {
    $abogados[] = $fila;
}

echo json_encode($abogados);
?>