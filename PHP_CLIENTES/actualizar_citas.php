<?php
// actualizar_cita.php
$conn = new mysqli("localhost","root","","bufete2");
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = intval($_POST['id']);
$nombre_cliente = $conn->real_escape_string($_POST['nombre_cliente']);
$correo = $conn->real_escape_string($_POST['correo']);
$servicio = $conn->real_escape_string($_POST['servicio']);
$precio = $conn->real_escape_string($_POST['precio']);
$duracion = $conn->real_escape_string($_POST['duracion']);
$fecha_reunion = $conn->real_escape_string($_POST['fecha_reunion']);
$hora_reunion = $conn->real_escape_string($_POST['hora_reunion']);
$id_abogado = intval($_POST['id_abogado']);

$sql = "UPDATE citas SET
    nombre_cliente='$nombre_cliente',
    correo='$correo',
    servicio='$servicio',
    precio='$precio',
    duracion='$duracion',
    fecha_reunion='$fecha_reunion',
    hora_reunion='$hora_reunion',
    id_abogado=$id_abogado
    WHERE id=$id";

if ($conn->query($sql) === TRUE) {
    echo "Cita actualizada correctamente.";
} else {
    echo "Error al actualizar cita: " . $conn->error;
}

$conn->close();
