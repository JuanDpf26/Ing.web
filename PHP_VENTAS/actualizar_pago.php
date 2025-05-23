<?php
$conn = new mysqli("localhost", "root", "", "bufete2");
$conn->set_charset("utf8");

// Obtener datos del formulario
$pago_id = $_POST['pago_id'];
$factura_id = $_POST['factura_id'];
$metodo_pago = $_POST['metodo_pago'];
$fecha_pago = $_POST['fecha_pago'];

// Validación básica
if (!$pago_id || !$factura_id || !$metodo_pago || !$fecha_pago) {
    echo "Campos incompletos.";
    exit;
}

// Preparar consulta de actualización
$stmt = $conn->prepare("UPDATE pagos 
    SET factura_id=?, metodo_pago=?, fecha_pago=? 
    WHERE pago_id=?");
$stmt->bind_param("issi", $factura_id, $metodo_pago, $fecha_pago, $pago_id);

// Ejecutar y devolver resultado
if ($stmt->execute()) {
    echo "Pago actualizado correctamente.";
} else {
    echo "Error al actualizar el pago.";
}
?>
