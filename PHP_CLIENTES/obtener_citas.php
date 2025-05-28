<?php
// obtener_citas.php
header('Content-Type: application/json');
$conn = new mysqli("localhost","root","","bufete2");

if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode([]);
    exit;
}

$sql = "SELECT * FROM citas";
$result = $conn->query($sql);

$citas = [];
if ($result) {
    while($row = $result->fetch_assoc()) {
        $citas[] = $row;
    }
}

echo json_encode($citas);
$conn->close();
