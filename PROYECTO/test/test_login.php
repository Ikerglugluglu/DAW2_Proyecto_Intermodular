<?php
// Archivo para probar login y roles
include '../control/roles.php';

// Verificar que solo clientes puedan acceder
checkRole('cliente');
echo "Bienvenido cliente, prueba exitosa.";
?>
