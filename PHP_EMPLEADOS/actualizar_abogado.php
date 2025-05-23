<?php
$conexion = new mysqli("localhost", "root", "", "bufete2");
$conexion->set_charset("utf8");

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$especialidad = $_POST['especialidad'];
$telefono = $_POST['telefono'];
$correo = $_POST['correo'];
$fecha = $_POST['fecha'];

$sql = "UPDATE abogados 
        SET nombre=?, especialidad=?, telefono=?, correo=?, fecha_contratacion=?
        WHERE id=?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("sssssi", $nombre, $especialidad, $telefono, $correo, $fecha, $id);

if ($stmt->execute()) {
    echo "Abogado actualizado correctamente.";
} else {
    echo "Error al actualizar: " . $stmt->error;
}

$conn->close();
?>
