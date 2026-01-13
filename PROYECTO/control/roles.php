<?php
// roles.php - funciones de control de acceso
session_start();

/**
 * Verifica si hay un usuario logueado
 */
function checkLogin() {
    if (!isset($_SESSION['id'])) {
        die("Acceso denegado. Debes iniciar sesión.");
    }
}

/**
 * Verifica que el usuario tenga un rol específico
 * @param string $rol_requerido Rol que se necesita ('cliente', 'admin', 'empleado', etc.)
 */
function checkRole($rol_requerido) {
    checkLogin();
    if (!isset($_SESSION['rol']) || $_SESSION['rol'] != $rol_requerido) {
        die("Acceso denegado. Solo usuarios con rol '$rol_requerido' pueden acceder.");
    }
}

/**
 * Funciones helper para roles frecuentes
 */
function esCliente() {
    return isset($_SESSION['rol']) && $_SESSION['rol'] == 'cliente';
}

function esAdmin() {
    return isset($_SESSION['rol']) && $_SESSION['rol'] == 'admin';
}

function esEmpleado() {
    return isset($_SESSION['rol']) && $_SESSION['rol'] == 'empleado';
}
?>

