<?php
header('Content-Type: application/json');

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bufete2";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(['success' => false, 'message' => 'Error de conexión a la base de datos']);
    exit;
}

// Recibir datos POST
$factura_id = $_POST['factura_id'] ?? null;
$cliente_id = $_POST['cliente_id'] ?? null;
$nombre_cliente = $_POST['nombre_cliente'] ?? null;
$servicio = $_POST['servicio'] ?? null;
$precio = $_POST['precio'] ?? null;
$fecha_reunion = $_POST['fecha_reunion'] ?? null;
$hora_reunion = $_POST['hora_reunion'] ?? null;
$fecha_creacion = $_POST['fecha_creacion'] ?? null;
$estado = $_POST['estado'] ?? null;

if (!$factura_id || !$cliente_id || !$nombre_cliente || !$servicio || !$precio || !$fecha_reunion || !$hora_reunion || !$fecha_creacion || !$estado) {
    echo json_encode(['success' => false, 'message' => 'Faltan datos obligatorios']);
    exit;
}

// Preparar y ejecutar actualización incluyendo fecha_creacion
$stmt = $conn->prepare("UPDATE factura SET cliente_id = ?, nombre_cliente = ?, servicio = ?, precio = ?, fecha_reunion = ?, hora_reunion = ?, fecha_creacion = ?, estado = ? WHERE factura_id = ?");
$stmt->bind_param("isssssssi", $cliente_id, $nombre_cliente, $servicio, $precio, $fecha_reunion, $hora_reunion, $fecha_creacion, $estado, $factura_id);

if ($stmt->execute()) {
    echo json_encode(['success' => true]);
} else {
    echo json_encode(['success' => false, 'message' => $stmt->error]);
}

$stmt->close();
$conn->close();
?>



