<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bufete2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener datos de la URL
$id = $_GET['id'];
$nombre_cliente = $_GET['nombre_cliente'];
$servicio = $_GET['servicio'];
$precio = $_GET['precio'];
$fecha_reunion = $_GET['fecha_reunion'];
$hora_reunion = $_GET['hora_reunion'];


$sql = "SELECT * FROM facturas WHERE cliente_id = '$id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<script>alert('¡Ya existe una factura con este ID!');</script>";
} else {
    $sql_insert = "INSERT INTO facturas (cliente_id, nombre_cliente, servicio, precio, fecha_reunion, hora_reunion, estado) 
                    VALUES ('$id', '$nombre_cliente', '$servicio', '$precio', '$fecha_reunion', '$hora_reunion', 'Pendiente')";

    if ($conn->query($sql_insert) === TRUE) {
        // Obtener el ID de la factura recién insertada
        $factura_id = $conn->insert_id;
    } else {
        echo "Error al generar factura: " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../CSS/factura.css">
    <title>Factura - <?php echo htmlspecialchars($nombre_cliente); ?></title>
</head>
<body>
    <div class="container">
        <div class="image-container">
            <img src="..//IMAGES/header.jpeg" alt="Imagen personalizada">
        </div>
        <div class="factura-details">
            <header>
                <h1>Factura de <?php echo htmlspecialchars($nombre_cliente); ?></h1>
            </header>
            <div class="factura-info">
                <p><strong>Nombre del Cliente:</strong> <?php echo htmlspecialchars($nombre_cliente); ?></p>
                <p><strong>Servicio:</strong> <?php echo htmlspecialchars($servicio); ?></p>
                <p><strong>Costo del Servicio:</strong> <?php echo htmlspecialchars($precio); ?></p>
                <p><strong>Fecha de la Reunión:</strong> <?php echo htmlspecialchars($fecha_reunion); ?></p>
                <p><strong>Hora de la Reunión:</strong> <?php echo htmlspecialchars($hora_reunion); ?></p>
                <p><strong>Hora de Generación de la Factura:</strong> <?php echo date("H:i:s"); ?></p>
            </div>
            <div class="payment-methods">
                <h3>Métodos de Pago</h3>
                <select name="metodo_pago" id="metodo_pago" required>
                    <option value="tarjeta">Tarjeta de Crédito/Débito</option>
                    <option value="transferencia">Transferencia Bancaria</option>
                    <option value="paypal">PayPal</option>
                </select>
               
                <input type="hidden" name="factura_id" id="factura_id" value="<?php echo $factura_id; ?>">
                <button type="button" onclick="location.href = 'procesar_pago.php?factura_id=<?php echo $factura_id; ?>&metodo_pago=' + document.getElementById('metodo_pago').value">Pagar</button>
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