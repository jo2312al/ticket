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
$estado_id = $data['estado_id'];
$estado_nuevo = $data['nuevo_estado'];
$caja_id = $data['caja_id'];


$sql = "UPDATE tickets SET estado_id = ?, caja_id = ? WHERE estado_id = ?";


$stmt = $conn->prepare($sql);
$stmt->bind_param("iii", $estado_nuevo, $caja_id, $estado_id);

if ($stmt->execute()) {
    echo json_encode(["success" => true]); 
} else {
    echo json_encode(["success" => false]); 
}


$stmt->close();
$conn->close();
?>
