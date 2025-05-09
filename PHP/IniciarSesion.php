<?php
session_start();
include 'conexion.php';

$correo = $_POST['correo'];
$password = $_POST['password'];

if (empty($correo) || empty($password)) {
    // Mensaje de error al dejar campos vacíos
    header("Location: ../HTML/InicioSesion.html?message=Todos%20los%20campos%20son%20obligatorios");
    exit();
}

// Verifica si el correo pertenece a un administrador por dominio
$esAdmin = strpos($correo, '@admin.com') !== false;

if ($esAdmin) {
    $query = "SELECT * FROM administradores WHERE Correo = ? AND password = ?";
} else {
    $query = "SELECT * FROM clientes WHERE Correo = ? AND password = ?";
}

$stmt = $conexion->prepare($query);
$stmt->bind_param("ss", $correo, $password);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $_SESSION['usuario'] = $correo;

    // Redirección según el tipo de usuario
    if ($esAdmin) {
        header("Location: ../HTML/Módulos.html?message=Bienvenido%20administrador");
    } else {
        header("Location: ../HTML/Home.html?message=Bienvenido%20cliente");
    }
} else {
    // Si las credenciales no son correctas, redirige con un mensaje de error
    header("Location: ../HTML/InicioSesion.html?message=Correo%20o%20contraseña%20incorrectos");
}

$stmt->close();
$conexion->close();
exit();
?>
