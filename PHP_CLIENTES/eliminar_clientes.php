<?php
$conn = new mysqli("localhost", "root", "", "bufete2");
$conn->set_charset("utf8");

$id = $_POST['id'];

if (!$id) {
    echo "ID no proporcionado.";
    exit;
}

$stmt = $conn->prepare("DELETE FROM clientes WHERE id = ?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Cliente eliminado correctamente.";
} else {
    echo "Error al eliminar.";
}
