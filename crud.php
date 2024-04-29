<?php
// Conexión a la base de datos (incluye tu archivo de conexión)
include('conexion_be.php');

// Función para obtener datos del usuario y perfil por ID
function obtenerDatosUsuario($user_id) {
    global $conexion;
    $sql = "SELECT r.name, r.surname, r.email, r.birthdate, p.direccion, p.telefono, p.ocupacion, p.estado FROM register r LEFT JOIN perfil p ON r.id = p.user_id WHERE r.id=$user_id";
    $result = mysqli_query($conexion, $sql);
    return ($result->num_rows > 0) ? $result->fetch_assoc() : false;
}

// Función para actualizar perfil de usuario
function actualizarPerfilUsuario($user_id, $direccion, $telefono, $ocupacion, $estado) {
    global $conexion;
    $sql = "INSERT INTO perfil (user_id, direccion, telefono, ocupacion, estado) VALUES ($user_id, '$direccion', '$telefono', '$ocupacion', '$estado') ON DUPLICATE KEY UPDATE direccion='$direccion', telefono='$telefono', ocupacion='$ocupacion', estado='$estado'";
    return mysqli_query($conexion, $sql);
}

// Obtener el ID del usuario (puedes obtenerlo de la sesión, por ejemplo)
$user_id = 1; // Ejemplo

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Recibir datos del formulario
    $direccion = $_POST['direccion'];
    $telefono = $_POST['telefono'];
    $ocupacion = $_POST['ocupacion'];
    $estado = $_POST['estado'];

    // Actualizar perfil del usuario
    if (actualizarPerfilUsuario($user_id, $direccion, $telefono, $ocupacion, $estado)) {
        echo "Perfil actualizado exitosamente.";
    } else {
        echo "Error al actualizar el perfil.";
    }
}

// Obtener y mostrar los datos del usuario
$datosUsuario = obtenerDatosUsuario($user_id);
if ($datosUsuario) {
    // Mostrar los datos en el formulario HTML
    ?>
    <form method="post">
        Dirección: <input type="text" name="direccion" value="<?php echo $datosUsuario['direccion']; ?>"><br>
        Teléfono: <input type="text" name="telefono" value="<?php echo $datosUsuario['telefono']; ?>"><br>
        Ocupación: <input type="text" name="ocupacion" value="<?php echo $datosUsuario['ocupacion']; ?>"><br>
        Estado: <input type="text" name="estado" value="<?php echo $datosUsuario['estado']; ?>"><br>
        <input type="submit" value="Actualizar">
        <a href="inicio.html" class="btn btn-primary">Regresar</a>
    </form>
    <?php
} else {
    echo "No se encontraron datos del usuario.";
}
?>