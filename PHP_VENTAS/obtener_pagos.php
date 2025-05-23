<?php
$conexion = new mysqli("localhost", "root", "", "bufete2");
$conexion->set_charset("utf8");

$resultado = $conexion->query("SELECT * FROM  pagos");
$pagos = [];

while ($fila = $resultado->fetch_assoc()) {
    $pagos[] = $fila;
}

echo json_encode($pagos);
?>