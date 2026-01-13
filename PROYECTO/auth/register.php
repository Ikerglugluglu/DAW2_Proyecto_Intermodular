<?php
// Registro de usuarios funcional
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
include '../config/config.php';

// Solo procesar POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Recoger datos del formulario
    $nombre = isset($_POST['nombre']) ? $conn->real_escape_string($_POST['nombre']) : '';
    $email = isset($_POST['email']) ? $conn->real_escape_string($_POST['email']) : '';
    $password = isset($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : '';
    $rol = 'cliente'; // columna de la tabla es 'rol'

    // Validar que los campos no estén vacíos
    if ($nombre == '' || $email == '' || $password == '') {
        die("Todos los campos son obligatorios.");
    }

    // Insertar en la base de datos
    $sql = "INSERT INTO users (nombre, email, password, rol) VALUES ('$nombre', '$email', '$password', '$rol')";

    if ($conn->query($sql) === TRUE) {
        echo "Usuario registrado correctamente";
    } else {
        echo "Error al registrar usuario: " . $conn->error;
    }
}
?>

<!-- Formulario simple para pruebas -->
<form method="post">
    Nombre: <input type="text" name="nombre" required><br>
    Email: <input type="email" name="email" required><br>
    Contraseña: <input type="password" name="password" required><br>
    <button type="submit">Registrar</button>
</form>
<form action="/PROYECTO/auth/go_index.php" method="post">
    <button type="submit">Inicio</button>
</form>
