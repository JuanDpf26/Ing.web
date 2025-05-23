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
$metodo_pago = $_GET['metodo_pago'];


$sql_update = "UPDATE facturas SET estado = 'Pagado' WHERE factura_id = '$factura_id'";

if ($conn->query($sql_update) === TRUE) {
  
    $sql_insert_pago = "INSERT INTO pagos (factura_id, metodo_pago, fecha_pago) 
                        VALUES ('$factura_id', '$metodo_pago', NOW())";

    if ($conn->query($sql_insert_pago) === TRUE) {
        header("Location: gracias.php?factura_id=$factura_id");
        exit();
    } else {
        echo "Error al registrar el pago: " . $conn->error;
    }
} else {
    echo "Error al actualizar la factura: " . $conn->error;
}

$conn->close();
?>


