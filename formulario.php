<?php include("conexion_bd.php")?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>
    <link rel="stylesheet" href="estilos/estilos.css">
</head>
<body>
    <header>
        <div class="encabezado">
            <p><b><i>W-School Cursos</i></b></p>
        </div>
    </header>

    <div class="formu-usuarios">
        <form method="post">

            <h2>Registro de Usuarios.</h2><br>
            <div>
                <label class="form-label">Identificación:</label>
                <input type="number" name="identificacion" required><br>
            </div>
            <div>
                <label class="form-label">Nombre:</label>
                <input type="text" name="nombre" required><br>
            </div>
            <div>
                <label class="form-label">Correo:</label>
                <input type="email" name="correo" required><br>
            </div>
            <div>
                <label class="form-label">Contraseña:</label>
                <input type="password" name="contraseña" required><br>
            </div>
            <button type="submit" >Guardar Datos.</button>

            <a href="inscripcion_curso.php">Registrarse a un curso.</a><br>

        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['identificacion'];
            $nombres = $_POST['nombre'];
            $correo = $_POST['correo'];
            $contraseña = $_POST['contraseña'];

            $stmt = $conexion->prepare("INSERT INTO usuario (id, nombres, correo, contraseña) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isss", $id, $nombres, $correo, $contraseña);
            $stmt->execute();
            session_start();
            if (!isset($_SESSION['cedula']) || !isset($_SESSION['nombre'])) {
            header("Location: formulario.php");
            exit();
            }
            echo "<div>Usuario registrado con exito. </div>";
            $stmt->close();
        }
        ?>

        <form action="listar.php" method="get">
            <button type="submit">Ver inscripciones registradas</button>
        </form>
        
    </div>
    
</body>
</html>