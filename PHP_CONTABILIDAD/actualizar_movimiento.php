<?php
// actualizar_contabilidad.php
header('Content-Type: text/plain; charset=utf-8');

$host = "localhost";
$user = "root";
$pass = "";
$db = "bufete2";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    echo "Error al conectar a la base de datos";
    exit;
}

$id = $_POST['id'] ?? 0;
$tipo = $_POST['tipo'] ?? '';
$concepto = trim($_POST['concepto'] ?? '');
$monto = $_POST['monto'] ?? 0;
$categoria = trim($_POST['categoria'] ?? '');
$fecha = $_POST['fecha'] ?? '';
$descripcion = trim($_POST['descripcion'] ?? '');

if (!$id || !in_array($tipo, ['Ingreso', 'Egreso']) || empty($concepto) || !is_numeric($monto) || $monto <= 0 || empty($fecha)) {
    echo "Complete todos los campos correctamente";
    exit;
}

$stmt = $conn->prepare("UPDATE movimientos SET tipo=?, concepto=?, monto=?, categoria=?, fecha=?, descripcion=? WHERE id=?");
$stmt->bind_param("ssdsssi", $tipo, $concepto, $monto, $categoria, $fecha, $descripcion, $id);

if ($stmt->execute()) {
    echo "Registro actualizado correctamente";
} else {
    echo "Error al actualizar el registro";
}

$stmt->close();
$conn->close();
?>

