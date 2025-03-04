<?php
header("Content-Type: application/json");

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_tickets";

// Conectar a la base de datos
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    echo json_encode(["success" => false, "error" => "Conexión fallida"]);
    exit;
}

// Obtener el total de tickets
$total_tickets = $conn->query("SELECT COUNT(*) AS total FROM tickets")->fetch_assoc()["total"];

// Obtener tickets resueltos (estado_id = 2)
$tickets_resueltos = $conn->query("SELECT COUNT(*) AS total FROM tickets WHERE estado_id = 2")->fetch_assoc()["total"];

// Obtener tickets pendientes (estado_id diferente de 2)
$tickets_pendientes = $total_tickets - $tickets_resueltos;

// Obtener cantidad de tickets por caja
$result = $conn->query("SELECT caja_id, COUNT(*) AS total FROM tickets where caja_id is not null GROUP BY caja_id");
$tickets_por_caja = [];
while ($row = $result->fetch_assoc()) {
    $tickets_por_caja["Caja " . $row["caja_id"]] = $row["total"];
}

// Enviar datos en JSON
echo json_encode([
    "total_tickets" => $total_tickets,
    "tickets_resueltos" => $tickets_resueltos,
    "tickets_pendientes" => $tickets_pendientes,
    "tickets_por_caja" => $tickets_por_caja
]);

$conn->close();
?>
