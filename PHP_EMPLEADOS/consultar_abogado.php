<?php
$conexion = new mysqli("localhost", "root", "", "bufete2");
$conexion->set_charset("utf8");

$result = $conn->query("SELECT * FROM abogados");

$abogados = [];

while ($row = $result->fetch_assoc()) {
    $abogados[] = $row;
}

echo json_encode($abogados);
$conn->close();
?>