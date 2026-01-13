<?php
include '../control/roles.php';

// Solo accesible a cliente
checkRole('cliente');

echo "Perfil de usuario: " . $_SESSION['nombre'];
