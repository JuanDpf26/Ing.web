<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli("localhost", "root", "", "bufete2");

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];

    // Validación básica
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        header("Location: clientes.php?seccion=crear&message=Correo%20inválido.");
        exit();
    }

    $stmt = $conn->prepare("SELECT * FROM clientes WHERE Id = ? OR Correo = ?");
    $stmt->bind_param("ss", $id, $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: clientes.php?seccion=crear&message=El%20ID%20o%20correo%20ya%20están%20registrados.");
        exit();
    }

    $stmt = $conn->prepare("INSERT INTO clientes (Id, Nombre, Edad, Correo, password) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("ssiss", $id, $nombre, $edad, $correo, $password);

    if ($stmt->execute()) {
        header("Location: clientes.php?seccion=crear&message=Cliente%20creado%20exitosamente.");
    } else {
        header("Location: clientes.php?seccion=crear&message=Error%20al%20crear%20el%20cliente.");
    }

    $stmt->close();
    $conn->close();
}
?>

