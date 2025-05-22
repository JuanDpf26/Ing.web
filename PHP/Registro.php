<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Conexión a la base de datos
    $servername = "localhost";
    $username = "root";
    $password_db = "";
    $dbname = "bufete2";

    $conn = new mysqli($servername, $username, $password_db, $dbname);

    if ($conn->connect_error) {
        die("Error de conexión: " . $conn->connect_error);
    }

    // Recoger datos del formulario
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $edad = $_POST['edad'];
    $correo = $_POST['correo'];
    $password = $_POST['password'];
    $tipo_usuario = $_POST['tipo']; // <- campo correcto

    // Validar tipo de usuario
    if ($tipo_usuario !== "cliente" && $tipo_usuario !== "administrador") {
        header("Location: ../HTML/Registro.html?message=Tipo%20de%20usuario%20inválido.");
        exit();
    }

    // Validar dominio del administrador
    if ($tipo_usuario === "administrador" && !str_ends_with($correo, "@admin.com")) {
        header("Location: ../HTML/Registro.html?message=El%20correo%20debe%20terminar%20en%20@admin.com%20para%20administradores.");
        exit();
    }

    // Elegir tabla según tipo de usuario
    $tabla = $tipo_usuario === "cliente" ? "clientes" : "administradores";

    // Verificar si ID o correo ya existe
    $sql_check = "SELECT * FROM $tabla WHERE Id = ? OR Correo = ?";
    $stmt = $conn->prepare($sql_check);
    $stmt->bind_param("ss", $id, $correo);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: ../HTML/Registro.html?message=El%20ID%20o%20correo%20ya%20están%20registrados.");
        exit();
    }

    // Insertar nuevo registro
    $sql_insert = "INSERT INTO $tabla (Id, Nombre, Edad, Correo, password) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql_insert);
    $stmt->bind_param("ssiss", $id, $nombre, $edad, $correo, $password);

    if ($stmt->execute()) {
        if ($tipo_usuario === "administrador") {
            header("Location: ../HTML/InicioSesion.html?message=Te%20has%20registrado%20como%20administrador.");
        } else {
            header("Location: ../HTML/InicioSesion.html?message=Registro%20exitoso.%20Por%20favor,%20inicia%20sesión.");
        }
    } else {
        header("Location: ../HTML/Registro.html?message=Error%20en%20el%20registro.%20Inténtalo%20nuevamente.");
    }

    $stmt->close();
    $conn->close();
}
?>



