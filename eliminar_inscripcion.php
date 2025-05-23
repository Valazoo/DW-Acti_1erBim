<?php
include("conexion_bd.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $id = $_POST['inscripcion_id'];
    $usuario_id = $_POST['usuario_id'];

    $stmt = $conexion->prepare("DELETE FROM inscripciones WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Redirige de nuevo al listado del usuario
        echo "<form id='redirect' method='post' action='listar.php'>
                <input type='hidden' name='usuario_id' value='$usuario_id'>
              </form>
              <script>document.getElementById('redirect').submit();</script>";
        exit;
    } else {
        echo "Error al eliminar inscripción: " . $stmt->error;
    }

    $stmt->close();
}
?>
