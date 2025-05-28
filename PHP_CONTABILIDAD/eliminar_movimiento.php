<?php
// eliminar_contabilidad.php
header('Content-Type: text/plain; charset=utf-8');

$host = "localhost";
$user = "root";
$pass = "";
$db = "bufete2";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo "Error al conectar a la base de datos";
    exit;
}

$id = $_POST['id'] ?? 0;
if (!$id) {
    echo "ID inválido";
    exit;
}

$stmt = $conn->prepare("DELETE FROM movimientos WHERE id=?");
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Registro eliminado correctamente";
} else {
    echo "Error al eliminar el registro";
}

$stmt->close();
$conn->close();
?>
