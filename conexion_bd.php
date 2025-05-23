<?php
    //Crear el objeto conexion a la base de datos
    $conexion = new mysqli("localhost", "root", "", "cursos_bd");

    //Verificar error de conexion
    if ($conexion->connect_error){
        die("Conexion fallida: " . $conexion->connect_error); //error
    }
?>

