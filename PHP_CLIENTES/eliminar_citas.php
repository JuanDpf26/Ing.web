<?php
// eliminar_cita.php
$conn = new mysqli("localhost","root","","bufete2");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = intval($_POST['id']);
$sql = "DELETE FROM citas WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Cita eliminada correctamente.";
} else {
    echo "Error al eliminar cita: " . $conn->error;
}

$conn->close();
