<?php
$conexion = mysqli_connect("localhost", "root", "", "bufete2");

if (!$conexion) {
    die("Error en la conexión: " . mysqli_connect_error());
}
?>