<?php
session_start();
echo "Bienvenido al proyecto backend de prueba.<br>";
if (isset($_SESSION['username'])) {
    echo "Usuario: " . $_SESSION['username'] . "<br>";
    echo "Rol: " . $_SESSION['role'] . "<br>";
    echo '<a href="auth/logout.php">Cerrar sesión</a>';
} else {
    echo '<a href="auth/login.php">Login</a> | <a href="auth/register.php">Registrar</a>';
}
?>
