<?php include("conexion_bd.php") ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos/estilos.css">
    <title>Inscripción a cursos</title>
</head>
<body>
    <header>
        <div class="encabezado">
            <p><b><i>W-School Cursos</i></b></p>
        </div>
    </header>

    <div>
        <form method="post">
            <h2>Inscripción a cursos</h2>
            <div>
                <label>Usuario:</label>
                <select name="usuario_id" required>
                    <option value="">Seleccione un usuario registrado.</option>
                    <?php
                    $usuarios = $conexion->query("SELECT id, nombres FROM usuario");
                    while ($user = $usuarios->fetch_assoc()) {
                        echo "<option value='{$user['id']}'>{$user['nombres']}</option>";
                    }
                    ?>
                </select>
            </div><br>

            <div>
                <label>Curso:</label>
                <select name="curso" required>
                    <option value="">Seleccione un curso:</option>
                    <option value="Programación">Programación</option>
                    <option value="Marketing Digital">Marketing Digital</option>
                    <option value="Gestión de Proyectos">Gestión de Proyectos</option>
                    <option value="Finanzas">Finanzas</option>
                    <option value="Diseño Gráfico">Diseño Gráfico</option>
                    <option value="Emprendimiento">Emprendimiento</option>
                </select>
            </div><br>

            <div>
                <label>Grupo:</label>
                <select name="grupo" required>
                    <option value="">Seleccione un grupo:</option>
                    <option value="100">100</option>
                    <option value="101">101</option>
                    <option value="102">102</option>
                </select>
            </div><br>

            <div>
                <label>Periodo:</label>
                <select name="periodo" required>
                    <option value="">Seleccione un periodo:</option>
                    <option value="Ene.2025-Jun.2025">Ene.2025-Jun.2025</option>
                    <option value="Jul.2025-Dic.2025">Jul.2025-Dic.2025</option>
                    <option value="Ene.2026-Jun.2026">Ene.2026-Jun.2026</option>
                    <option value="Jul.2026-Dic.2026">Jul.2026-Dic.2026</option>
                </select>
            </div><br>


            <button type="submit">Guardar inscripción</button>
            
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $usuario_id = $_POST['usuario_id'];
            $curso = $_POST['curso'];
            $grupo = $_POST['grupo'];
            $periodo = $_POST['periodo'];

            $stmt = $conexion->prepare("INSERT INTO inscripciones (usuario_id, curso, grupo, periodo) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("isis", $usuario_id, $curso, $grupo, $periodo);

            if ($stmt->execute()) {
                echo "<div>Inscripción registrada con éxito.</div>";
                
            } else {
                echo "<div>Error al registrar la inscripción: " . $stmt->error . "</div>";
            }

            $stmt->close();
        }
        ?>

        <form action="index.php" method="get" style="margin-top: 20px;">
            <button type="submit">Volver a la página principal</button>
        </form><br>

        <form action="listar.php" method="get">
            <button type="submit">Ver inscripciones registradas</button>
        </form><br>


    </div>

</body>
</html>