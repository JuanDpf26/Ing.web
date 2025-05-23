<?php
$conn = new mysqli("localhost", "root", "", "bufete2");
$conn->set_charset("utf8");

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$edad = $_POST['edad'];
$correo = $_POST['correo'];

if (!$id || !$nombre || !$edad || !$correo) {
    echo "Campos incompletos.";
    exit;
}

$stmt = $conn->prepare("UPDATE clientes SET nombre=?, edad=?, correo=? WHERE id=?");
$stmt->bind_param("sisi", $nombre, $edad, $correo, $id);

if ($stmt->execute()) {
    echo "Cliente actualizado correctamente.";
} else {
    echo "Error al actualizar.";
}
