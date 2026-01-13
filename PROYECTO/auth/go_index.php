<?php
session_start();

// Usuario anónimo
if (!isset($_SESSION['role'])) {
    header('Location: /PROYECTO/index.php');
    exit;
}

// Usuario autenticado según rol
if ($_SESSION['role'] === 'admin') {
    header('Location: /PROYECTO/admin/index.php');
} elseif ($_SESSION['role'] === 'empleado') {
    header('Location: /PROYECTO/empleado/index.php');
} else {
    // cliente
    header('Location: /PROYECTO/cliente/index.php');
}

exit;
