<?php
session_start();

$servername = "localhost";
$username = "root";
$password_db = "";
$dbname = "bufete2";

$conn = new mysqli($servername, $username, $password_db, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Eliminar cliente
if (isset($_GET['eliminar'])) {
    $id = $_GET['eliminar'];
    $conn->query("DELETE FROM clientes WHERE Id = '$id'");
    $_SESSION['mensaje'] = "Cliente eliminado correctamente.";
    header("Location: clientes.php");
    exit();
}

// Actualizar cliente
if (isset($_POST['actualizar'])) {
    $id = $_POST['id'];
    $nombre = trim($_POST['nombre']);
    $edad = trim($_POST['edad']);
    $correo = trim($_POST['correo']);

    if ($nombre == "" || $edad == "" || $correo == "") {
        $_SESSION['error'] = "Todos los campos deben estar llenos para actualizar.";
    } else {
        $conn->query("UPDATE clientes SET Nombre='$nombre', Edad='$edad', Correo='$correo' WHERE Id='$id'");
        $_SESSION['mensaje'] = "Cliente actualizado correctamente.";
    }
    header("Location: clientes.php");
    exit();
}

// Buscar cliente
$cliente_buscado = null;
if (isset($_POST['buscar'])) {
    $id_buscar = $_POST['buscar_id'];
    $result = $conn->query("SELECT * FROM clientes WHERE Id = '$id_buscar'");
    if ($result->num_rows > 0) {
        $cliente_buscado = $result->fetch_assoc();
    } else {
        $_SESSION['error'] = "Cliente no encontrado con ID: $id_buscar";
        header("Location: clientes.php");
        exit();
    }
}

// Obtener todos los clientes
$result_clientes = $conn->query("SELECT * FROM clientes");
?>
