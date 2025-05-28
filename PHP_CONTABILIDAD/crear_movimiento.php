<?php
// crear_movimiento.php
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

$tipo = $_POST['tipo'] ?? '';
$concepto = trim($_POST['concepto'] ?? '');
$monto = $_POST['monto'] ?? 0;
$categoria = trim($_POST['categoria'] ?? '');
$fecha = $_POST['fecha'] ?? '';
$descripcion = trim($_POST['descripcion'] ?? '');

if (!in_array($tipo, ['Ingreso', 'Egreso'])) {
    echo "Tipo inválido";
    exit;
}

if (empty($concepto) || !is_numeric($monto) || $monto <= 0 || empty($fecha)) {
    echo "Complete todos los campos obligatorios correctamente";
    exit;
}

$stmt = $conn->prepare("INSERT INTO movimientos (tipo, concepto, monto, categoria, fecha, descripcion) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssdsss", $tipo, $concepto, $monto, $categoria, $fecha, $descripcion);

if ($stmt->execute()) {
    echo "Movimiento guardado correctamente";
} else {
    echo "Error al guardar el movimiento";
}

$stmt->close();
$conn->close();
?>
