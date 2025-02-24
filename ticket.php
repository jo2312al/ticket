<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$database = "sistema_tickets";

$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el último ticket registrado
$sql = "SELECT nombre FROM tickets ORDER BY id DESC LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $ultimo_ticket = $row['nombre'];
    
    // Extraer los últimos dos dígitos numéricos (ejemplo: "AA45" → "45")
    $numero_actual = intval(substr($ultimo_ticket, -2));
} else {
    // Si no hay registros, comenzamos desde "AA00"
    $numero_actual = -1;
}

// Incrementar el número y reiniciar si llega a 100
$nuevo_numero = ($numero_actual + 1) % 100;

// Generar el nuevo nombre del ticket (ejemplo: "AA01", "AA99", "AA00")
$nombre_ticket = "AA" . str_pad($nuevo_numero, 2, "0", STR_PAD_LEFT);

// Insertar el nuevo ticket en la base de datos
$sql_insert = "INSERT INTO tickets (nombre, estado_id) VALUES ('$nombre_ticket', 1)";
$conn->query($sql_insert);

echo "Nuevo ticket generado: " . $nombre_ticket;

// Cerrar la conexión
$conn->close();
?>
