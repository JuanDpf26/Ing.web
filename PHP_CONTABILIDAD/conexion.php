<?php
$host = "localhost";
$user = "root"; // Ajusta según tu configuración
$password = ""; // Ajusta según tu configuración
$db = "bufete2";

$conn = new mysqli($host, $user, $password, $db);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
