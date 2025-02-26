<?php
$servername = "localhost";
$username = "root";  
$password = "";     
$dbname = "sistema_tickets";  


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$data = json_decode(file_get_contents('php://input'), true);
$estado_id_actual = $data['estado_id_actual'];
$estado_id_nuevo = $data['estado_id_nuevo'];

$sql = "UPDATE tickets SET estado_id = ? WHERE estado_id = ? LIMIT 1";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ii", $estado_id_nuevo, $estado_id_actual);


if ($stmt->execute()) {
    echo json_encode(["success" => true]); 
} else {
    echo json_encode(["success" => false]); 
}


$stmt->close();
$conn->close();
?>
