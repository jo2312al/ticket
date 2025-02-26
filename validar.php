<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "sistema_tickets";  


$conn = new mysqli($servername, $username, $password, $dbname);


if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


$usuario = $_POST['usuario'];
$contraseña = $_POST['contraseña'];


$sql = "SELECT * FROM cajeros WHERE usuario = '$usuario' AND contraseña = '$contraseña'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    
    echo "Inicio de sesión exitoso."; 
} else {

    echo "Usuario o contraseña incorrectos";
}

$conn->close();
?>
