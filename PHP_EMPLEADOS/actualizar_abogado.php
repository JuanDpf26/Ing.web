<?php
$conn = new mysqli("localhost", "root", "", "bufete2");
$conn->set_charset("utf8");

// Obtener datos del formulario
$id = $_POST['id'];
$nombre = $_POST['nombre'];
$especialidad = $_POST['especialidad'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$fecha = $_POST['fecha']; // fecha_contratacion

// Validación básica
if (!$id || !$nombre || !$especialidad || !$telefono || !$correo || !$fecha) {
    echo "Campos incompletos.";
    exit;
}

// Preparar consulta de actualización
$stmt = $conn->prepare("UPDATE abogados SET nombre=?, especialidad=?, telefono=?, correo=?, fecha_contratacion=? WHERE id=?");
$stmt->bind_param("sssssi", $nombre, $especialidad, $telefono, $correo, $fecha, $id);

// Ejecutar y devolver resultado
if ($stmt->execute()) {
    echo "Abogado actualizado correctamente.";
} else {
    echo "Error al actualizar.";
}

