<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_tickets";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}


$sql_caja1 = "SELECT nombre FROM tickets WHERE estado_id = 3 ORDER BY id ASC LIMIT 1";
$sql_caja2 = "SELECT nombre FROM tickets WHERE estado_id = 4 ORDER BY id ASC LIMIT 1";
$sql_caja3 = "SELECT nombre FROM tickets WHERE estado_id = 5 ORDER BY id ASC LIMIT 1";
$sql_caja4 = "SELECT nombre FROM tickets WHERE estado_id = 6 ORDER BY id ASC LIMIT 1";


$result_caja1 = $conn->query($sql_caja1);
$result_caja2 = $conn->query($sql_caja2);
$result_caja3 = $conn->query($sql_caja3);
$result_caja4 = $conn->query($sql_caja4);


$caja1 = $result_caja1->fetch_assoc();
$caja2 = $result_caja2->fetch_assoc();
$caja3 = $result_caja3->fetch_assoc();
$caja4 = $result_caja4->fetch_assoc();

$response = [
    'caja1' => $caja1['nombre'] ?? 'Cerrada',
    'caja2' => $caja2['nombre'] ?? 'Cerrada',
    'caja3' => $caja3['nombre'] ?? 'Cerrada',
    'caja4' => $caja4['nombre'] ?? 'Cerrada',
];

echo json_encode($response);
$conn->close();
?>
