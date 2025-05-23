<?php
$conexion = new mysqli("localhost", "root", "", "bufete2");
$conexion->set_charset("utf8");

// Nombres deben coincidir con los del formulario
$abogado_id = $_POST['abogado_id'] ?? null;
$nombre = $_POST['nombre'] ?? null;
$salario_base = $_POST['salario_base'] ?? 0;
$bonificaciones = $_POST['bonificaciones'] ?? 0;
$descuentos = $_POST['descuentos'] ?? 0;

if (!$abogado_id || !$nombre) {
    echo "Faltan datos obligatorios: ID o nombre del abogado.";
    exit;
}

// Insertar en nóminas
$sql_insert = "INSERT INTO nominas (abogado_id, nombre_abogado, salario_base, bonificaciones, descuentos)
               VALUES (?, ?, ?, ?, ?)";
$stmt_insert = $conexion->prepare($sql_insert);

if (!$stmt_insert) {
    echo "Error en la preparación de la consulta: " . $conexion->error;
    exit;
}

$stmt_insert->bind_param("issdd", $abogado_id, $nombre, $salario_base, $bonificaciones, $descuentos);

if ($stmt_insert->execute()) {
    echo "Nómina registrada correctamente.";
} else {
    echo "Error al registrar la nómina: " . $stmt_insert->error;
}

$stmt_insert->close();
$conexion->close();
?>




