<?php
header('Content-Type: application/json');

// Conexión a la base de datos
$conexion = new mysqli('localhost', 'usuario', 'contraseña', 'base_de_datos');

if ($conexion->connect_error) {
    die(json_encode(['error' => 'Error de conexión']));
}

// Obtener clientes atendidos por caja
$resultado = $conexion->query("SELECT caja, COUNT(*) as total FROM turnos WHERE estado='atendido' GROUP BY caja");
$atendidos = $resultado->fetch_all(MYSQLI_ASSOC);

// Obtener clientes que no asistieron
$resultado = $conexion->query("SELECT COUNT(*) as total FROM turnos WHERE estado='no_asistio'");
$no_asistieron = $resultado->fetch_assoc();

// Respuesta en formato JSON
echo json_encode([
    'atendidos' => $atendidos,
    'no_asistieron' => $no_asistieron['total']
]);

$conexion->close();
?>
