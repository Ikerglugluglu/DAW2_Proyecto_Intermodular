<?php
// config.php
$host = "localhost";
$db_user = "admin";
$db_pass = "admin";
$db_name = "restaurante_durums";

// Conexión a la base de datos usando mysqli
$conn = new mysqli($host, $db_user, $db_pass, $db_name);

// Comprobar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
