<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bufete2";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$factura_id = $_GET['factura_id'] ?? '';

$sql = "SELECT * FROM facturas WHERE factura_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $factura_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $factura = $result->fetch_assoc();
    $nombre_cliente = $factura['nombre_cliente'];
    $servicio = $factura['servicio'];
    $precio = $factura['precio'];
    $estado = $factura['estado'];

    if ($estado === 'Pagada') {
        echo "<script>alert('Esta factura ya ha sido pagada previamente.'); window.location.href='gracias.php';</script>";
        exit();
    }

    $update_sql = "UPDATE facturas SET estado = 'Pagada' WHERE factura_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("i", $factura_id);
    $update_stmt->execute();

    // Limpieza del valor numérico
    $precio_limpio = floatval(preg_replace('/[^\d.]/', '', $precio));
} else {
    echo "Factura no encontrada.";
    exit();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gracias por tu Pago</title>
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
            background: linear-gradient(to bottom, #fffbea, #fffde6);
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .gracias-container {
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(255, 200, 0, 0.3);
            text-align: center;
            max-width: 480px;
            border: 1px solid #ffe97f;
        }
        h1 {
            color: #f7b500;
            margin-bottom: 10px;
            font-size: 28px;
        }
        .descripcion {
            color: #444;
            margin-bottom: 10px;
        }
        .detalle {
            font-weight: 600;
            color: #555;
            margin: 15px 0;
        }
        .detalle span {
            color: #333;
        }
        .btn {
            display: inline-block;
            margin-top: 25px;
            padding: 12px 22px;
            background-color: #f7b500;
            color: #fff;
            border: none;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: background 0.3s ease;
        }
        .btn:hover {
            background-color: #e3a000;
        }
    </style>
</head>
<body>
    <div class="gracias-container">
        <h1>¡Gracias, <?php echo htmlspecialchars($nombre_cliente); ?>!</h1>
        <p class="descripcion">Has pagado la factura por el servicio de:</p>
        <p class="detalle">📄 <span><?php echo htmlspecialchars($servicio); ?></span></p>
        <p class="detalle">💰 Costo: <span>$<?php echo number_format($precio_limpio, 2); ?></span></p>
        <p class="detalle">📌 Estado de la factura: <span>Pagada</span></p>
        <a class="btn" href="../HTML/home.html">🏁 Finalizar y Regresar</a>
    </div>
</body>
</html>


