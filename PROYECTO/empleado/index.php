<?php

include '../control/roles.php';

// Solo accesible a admin
checkRole('empleado');

echo "Bienvenido al panel de empleado, " . $_SESSION['nombre'];
