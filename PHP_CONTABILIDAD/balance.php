<?php
$conexion = new mysqli("localhost", "root", "", "bufete2");
if ($conexion->connect_error) {
    echo json_encode(["error" => "Error de conexión."]);
    exit;
}

$sql = "SELECT 
            SUM(CASE WHEN tipo = 'Ingreso' THEN monto ELSE 0 END) AS totalIngresos,
            SUM(CASE WHEN tipo = 'Egreso' THEN monto ELSE 0 END) AS totalEgresos
        FROM movimientos";

$resultado = $conexion->query($sql);

if ($resultado && $fila = $resultado->fetch_assoc()) {
    echo json_encode([
        "totalIngresos" => floatval($fila['totalIngresos']),
        "totalEgresos" => floatval($fila['totalEgresos'])
    ]);
} else {
    echo json_encode(["error" => "Error al obtener los datos."]);
}

$conexion->close();
?>

