<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bufete2";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$factura_id = $_GET['factura_id'];


$sql = "SELECT * FROM facturas WHERE factura_id = '$factura_id'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $factura = $result->fetch_assoc();
    $nombre_cliente = $factura['nombre_cliente'];
    $servicio = $factura['servicio'];
    $precio = $factura['precio'];
    $estado = $factura['estado'];

    
    if ($estado == 'Pagada') {
        
        echo "<script>alert('Esta factura ya ha sido pagada previamente.'); window.location.href='gracias.php';</script>";
        exit(); 
    }

   
    $update_sql = "UPDATE facturas SET estado = 'Pagada' WHERE factura_id = '$factura_id'";
    $conn->query($update_sql);
} else {
    echo "Factura no encontrada.";
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="..//CSS/gracias.css">
    <title>Gracias por tu Pago</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .gracias-container {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            width: 80%;
            max-width: 500px;
        }
        .gracias-container h1 {
            font-size: 2em;
            color: #28a745;
            margin-bottom: 20px;
        }
        .gracias-container p {
            font-size: 1.2em;
            color: #333;
        }
        .gracias-container .details {
            margin: 20px 0;
            font-size: 1.1em;
            color: #555;
        }
        .gracias-container .btn {
            display: inline-block;
            padding: 10px 20px;
            font-size: 1em;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }
        .gracias-container .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="gracias-container">
        <h1>¡Su factura a sido pagada, <?php echo htmlspecialchars($nombre_cliente); ?>!</h1>
        <p>Tu factura de <strong><?php echo htmlspecialchars($servicio); ?></strong> por <p><strong>Costo del Servicio:</strong> <?php echo htmlspecialchars($precio); ?> ?></strong> ha sido pagada exitosamente.</p>
        <p class="details">Estado de la factura: <strong>Pagada</strong></p>
        <a href="..//HTML/home.html" class="btn">Volver a la página principal</a>
    </div>
</body>
</html>
