<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $conn = new mysqli("localhost", "root", "", "bufete2");
    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }
    $conn->set_charset("utf8");

    // Recibir y sanitizar datos
    $nombre = trim($_POST['nombre']);
    $especialidad = trim($_POST['especialidad']);
    $telefono = trim($_POST['telefono']);
    $correo = trim($_POST['correo']);
    $fecha = trim($_POST['fecha']);

    // Validación básica de correo
    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
        echo "Correo inválido.";
        exit();
    }

    // Validar que no haya abogado con el mismo correo o teléfono
    $stmt = $conn->prepare("SELECT * FROM abogados WHERE correo = ? OR telefono = ?");
    $stmt->bind_param("ss", $correo, $telefono);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        echo "Ya existe un abogado registrado con ese correo o teléfono.";
        $stmt->close();
        $conn->close();
        exit();
    }
    $stmt->close();

    // Insertar nuevo abogado
    $stmt = $conn->prepare("INSERT INTO abogados (nombre, especialidad, telefono, correo, fecha_contratacion) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("sssss", $nombre, $especialidad, $telefono, $correo, $fecha);

    if ($stmt->execute()) {
        echo "Abogado registrado con éxito.";
    } else {
        echo "Error al registrar abogado: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>
