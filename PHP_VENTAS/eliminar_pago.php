<?php
$conn = new mysqli("localhost", "root", "", "bufete2");
$conn->set_charset("utf8");

// Obtener ID
$pago_id = $_POST['pago_id'];

if (!$pago_id) {
    echo "ID de pago no proporcionado.";
    exit;
}

// Preparar y ejecutar eliminación
$stmt = $conn->prepare("DELETE FROM pagos WHERE pago_id = ?");
$stmt->bind_param("i", $pago_id);

if ($stmt->execute()) {
    echo "Pago eliminado correctamente.";
} else {
    echo "Error al eliminar el pago.";
}
?>
