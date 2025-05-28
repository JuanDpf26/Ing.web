<?php
header('Content-Type: application/json; charset=utf-8');

$host = "localhost";
$user = "root";
$pass = "";
$db = "bufete2";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo json_encode([]);
    exit;
}

$sql = "SELECT id, tipo, concepto, monto, categoria, fecha, descripcion FROM movimientos ORDER BY fecha DESC, id DESC";
$result = $conn->query($sql);

$movimientos = [];

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $movimientos[] = $row;
    }
}

echo json_encode($movimientos);

$conn->close();


