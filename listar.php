<?php
include("conexion_bd.php");

$usuario_id = isset($_POST['usuario_id']) ? $_POST['usuario_id'] : null;
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Inscripciones por Usuario</title>
    <link rel="stylesheet" href="estilos/estilos.css">
</head>
<body>
    
    <form method="post">
    <h2>Consultar Inscripciones de Usuarios.</h2>

        <label for="usuario_id">Seleccionar usuario:</label>
        <select name="usuario_id" required>
            <option value="">Seleccione un usuario</option>
            <?php
            $usuarios = $conexion->query("SELECT id, nombres FROM usuario");
            while ($user = $usuarios->fetch_assoc()) {
                $selected = ($usuario_id == $user['id']) ? 'selected' : '';
                echo "<option value='{$user['id']}' $selected>{$user['nombres']}</option>";
            }
            ?>
        </select>
        <button type="submit">Ver inscripciones</button>
    </form> <br>

    <?php if ($usuario_id): ?>
        <h3>Inscripciones del usuario seleccionado:</h3>

        <?php
        $query = $conexion->prepare("SELECT * FROM inscripciones WHERE usuario_id = ?");
        $query->bind_param("i", $usuario_id);
        $query->execute();
        $result = $query->get_result();

        if ($result->num_rows > 0): ?>
            <table border="1" cellpadding="10" style="margin-top: 20px;">
                <tr>
                    <th>Curso</th>
                    <th>Grupo</th>
                    <th>Periodo</th>
                    <th>Acción</th>
                </tr>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?= htmlspecialchars($row['curso']) ?></td>
                        <td><?= htmlspecialchars($row['grupo']) ?></td>
                        <td><?= htmlspecialchars($row['periodo']) ?></td>
                        <td>
                            <form method="post" action="eliminar_inscripcion.php" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta inscripción?');">
                                <input type="hidden" name="inscripcion_id" value="<?= $row['id'] ?>">
                                <input type="hidden" name="usuario_id" value="<?= $usuario_id ?>">
                                <button type="submit">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No hay inscripciones para este usuario.</p>
            <form action="index.html" method="get" style="margin-top: 20px;">
            <a href="inscripcion_curso.php">Registrarse a un curso.</a>
            </form>
        <?php endif;

        $query->close();
        ?>

        <form action="index.html" method="get" style="margin-top: 20px;">
            <button type="submit">Volver a la página principal</button><br>
        </form>

    <?php endif; ?>
</body>
</html>