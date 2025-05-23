<?php include 'conexion.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Clientes - Bufete</title>
    <link rel="stylesheet" href="estilos.css">
</head>
<body>
<div class="sidebar">
    <a href="index.php">Inicio</a>
    <a href="crear.php">Crear Cliente</a>
    <a href="index.php">Ver Todos</a>
</div>

<div class="main">
    <h1>Clientes</h1>
    <table border="1" cellpadding="8">
        <tr>
            <th>ID</th><th>Nombre</th><th>Edad</th><th>Correo</th><th>Acciones</th>
        </tr>
        <?php
        $resultado = $conexion->query("SELECT * FROM clientes");
        while ($fila = $resultado->fetch_assoc()) {
            echo "<tr>
                <td>{$fila['id']}</td>
                <td>{$fila['nombre']}</td>
                <td>{$fila['edad']}</td>
                <td>{$fila['correo']}</td>
                <td>
                    <a href='editar.php?id={$fila['id']}'>Editar</a> |
                    <a href='eliminar.php?id={$fila['id']}' onclick='return confirm(\"¿Eliminar cliente?\")'>Eliminar</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</div>
</body>
</html>
