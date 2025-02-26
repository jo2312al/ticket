<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "sistema_tickets";

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$sql = "SELECT nombre FROM tickets ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ultimo_ticket = $row['nombre'];
    
    $numero_actual = intval(substr($ultimo_ticket, -2));
} else {
    $numero_actual = -1;
}

$nuevo_numero = ($numero_actual + 1) % 100;

$nombre_ticket = "ET" . str_pad($nuevo_numero, 2, "0", STR_PAD_LEFT);

$sql_insert = "INSERT INTO tickets (nombre, estado_id) VALUES ('$nombre_ticket', 1)";
$conn->query($sql_insert);

echo "Nuevo ticket generado: " . $nombre_ticket;

$conn->close();
?>
