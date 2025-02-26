<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_tickets";


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}


$sql = "SELECT nombre FROM tickets WHERE estado_id = 1 ORDER BY id ASC LIMIT 10";
$result = $conn->query($sql);


if ($result === false) {
   
    echo json_encode(['error' => 'Hubo un error al consultar la base de datos']);
    $conn->close();
    exit;
}


$datos = [];

while ($row = $result->fetch_assoc()) {
    $datos[] = $row;
}


if (empty($datos)) {
    echo json_encode(['mensaje' => 'No hay tickets disponibles']);
} else {
  
    echo json_encode($datos);
}


$conn->close();
?>
