<?php

$id = $_GET['id'];
$nombre_cliente = $_GET['nombre_cliente'];
$servicio = $_GET['servicio'];
$precio = $_GET['precio'];
$duracion = $_GET['duracion'];
$fecha_reunion = $_GET['fecha_reunion'];
$hora_reunion = $_GET['hora_reunion'];
$nombre_abogado = $_GET['nombre_abogado'];
$especialidad_abogado = $_GET['especialidad_abogado'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirmación de Cita</title>
    <link rel="stylesheet" href="../CSS/confirmacion.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    
</head>
<body>
    <div class="main-container">
        
        <div class="left-section">
            <img src="..//IMAGES/header.jpeg" alt="Imagen de Confirmación" class="confirm-img">
        </div>

    
        <div class="right-section">
            <div class="container">
                <header>
                    <h1>Confirmación de Cita</h1>
                </header>
                <div class="cita-info">
                    <div class="info-box">
                        <h3>Detalles de la Cita</h3>
                        <p><strong>Nombre del Cliente:</strong> <?php echo htmlspecialchars($nombre_cliente); ?></p>
                        <p><strong>Servicio:</strong> <?php echo htmlspecialchars($servicio); ?></p>
                        <p><strong>Costo del Servicio:</strong> <?php echo htmlspecialchars($precio); ?></p>
                        <p><strong>Duración:</strong> <?php echo htmlspecialchars($duracion); ?></p>
                        <p><strong>Fecha de la Reunión:</strong> <?php echo htmlspecialchars($fecha_reunion); ?></p>
                        <p><strong>Hora de la Reunión:</strong> <?php echo htmlspecialchars($hora_reunion); ?></p>
                    </div>

                    <div class="info-box">
                        <h3>Detalles del Abogado</h3>
                        <p><strong>Nombre del Abogado:</strong> <?php echo htmlspecialchars($nombre_abogado); ?></p>
                        <p><strong>Especialidad:</strong> <?php echo htmlspecialchars($especialidad_abogado); ?></p>
                    </div>
                </div>
                <div class="action">
                    <p><i class="fas fa-check-circle"></i> ¡Su cita ha sido programada exitosamente!</p>
                    <a href="generar_factura.php?id=<?php echo $id; ?>&nombre_cliente=<?php echo $nombre_cliente; ?>&servicio=<?php echo $servicio; ?>&precio=<?php echo $precio; ?>&fecha_reunion=<?php echo $fecha_reunion; ?>&hora_reunion=<?php echo $hora_reunion; ?>" class="btn-pagar">Generar Factura</a>
                </div>
            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="footer-content">
            <p>&copy; 2024 Rastro Legal Vial. Todos los derechos reservados.</p>
        </div>
    </footer>
</body>
</html>





