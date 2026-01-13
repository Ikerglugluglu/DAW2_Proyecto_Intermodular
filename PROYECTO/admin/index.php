<?php

include '../control/roles.php';

// Solo accesible a admin
checkRole('admin');

echo "Bienvenido al panel de administración, " . $_SESSION['nombre'];
