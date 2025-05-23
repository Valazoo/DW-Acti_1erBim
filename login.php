<?php
session_start();

// Validar si hay sesión activa
if (!isset($_SESSION['cedula']) || !isset($_SESSION['nombre'])) {
    header("Location: formulario.php");
    exit();
}
?>