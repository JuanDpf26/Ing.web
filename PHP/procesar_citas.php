<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bufete2";  


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$id = $_POST['id'];
$nombre_cliente = $_POST['nombre_cliente'];
$correo = $_POST['correo'];
$servicio = $_POST['servicio'];
$precio = $_POST['precio'];
$duracion = $_POST['duracion'];
$fecha_reunion = $_POST['fecha_reunion'];
$hora_reunion = $_POST['hora_reunion'];


$sql_check_id = "SELECT id FROM citas WHERE id = '$id'";
$result_id = $conn->query($sql_check_id);

if ($result_id->num_rows > 0) {
    
    header("Location: ../HTML/programar_citas.html?message=" . urlencode("El ID del cliente ya está registrado"));
    exit();
}


$sql_check_email = "SELECT correo FROM citas WHERE correo = '$correo'";
$result_email = $conn->query($sql_check_email);

if ($result_email->num_rows > 0) {
    
    header("Location: ../HTML/programar_citas.html?message=" . urlencode("El correo ya está registrado"));
    exit();
}


$sql_abogado = "SELECT id, nombre, especialidad FROM abogados WHERE especialidad = '$servicio' LIMIT 1";
$result_abogado = $conn->query($sql_abogado);

if ($result_abogado->num_rows > 0) {
    $abogado = $result_abogado->fetch_assoc();
    $id_abogado = $abogado['id'];
    $nombre_abogado = $abogado['nombre'];
    $especialidad_abogado = $abogado['especialidad'];
} else {
  
    header("Location: ../HTML/programar_citas.html?message=" . urlencode("No hay abogado disponible para este servicio"));
    exit();
}


$sql = "INSERT INTO citas (id, nombre_cliente, correo, servicio, precio, duracion, fecha_reunion, hora_reunion, id_abogado) 
        VALUES ('$id', '$nombre_cliente', '$correo', '$servicio', '$precio', '$duracion', '$fecha_reunion', '$hora_reunion', '$id_abogado')";

if ($conn->query($sql) === TRUE) {

    header("Location: confirmacion_cita.php?message=" . urlencode("Cita Programada") . "&id=$id&nombre_cliente=$nombre_cliente&servicio=$servicio&precio=$precio&duracion=$duracion&fecha_reunion=$fecha_reunion&hora_reunion=$hora_reunion&nombre_abogado=$nombre_abogado&especialidad_abogado=$especialidad_abogado");
    exit();
} else {
    
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>







