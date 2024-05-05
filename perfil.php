<?php
session_start(); // Iniciar sesión
$user_id = isset($_SESSION['usuario_id']) ? $_SESSION['usuario_id'] : false;

// Si no hay ID en la sesión, redirigir a login o mostrar mensaje
if (!$user_id) {
  // Redirigir a login o mostrar mensaje de error
  header("Location: login.php"); // Ejemplo de redirección
  exit();
}
// Conexión a la base de datos (incluye tu archivo de conexión)
include('conexion_be.php');
// Función para obtener datos del usuario y perfil por ID
function obtenerDatosUsuario($user_id) {
    global $conexion;
    $sql = "SELECT r.name, r.surname, r.email, r.birthdate, p.direccion, p.telefono, p.ocupacion, p.estado FROM register r LEFT JOIN perfil p ON r.id = p.user_id WHERE r.id=$user_id";
    $result = mysqli_query($conexion, $sql);
    return ($result->num_rows > 0) ? $result->fetch_assoc() : false;
}

// Obtener el ID del usuario (puedes obtenerlo de la sesión, por ejemplo)
//$user_id = 7; // Ejemplo

// Obtener y mostrar los datos del usuario
$datosUsuario = obtenerDatosUsuario($user_id);
if ($datosUsuario) {
    // Mostrar los datos en la página HTML
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Perfil PsicoAmigo</title>
        <link rel="stylesheet" type="text/css" href="../login-register/estilop.css">
        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    </head>
    <body>
        <section class="seccion-perfil-usuario">
            <div class="perfil-usuario-header">
                <div class="perfil-usuario-portada">
                    <div class="perfil-usuario-avatar">
                        <img src="../login-register/assets/img/avatar.jpg" alt="img-avatar">
                    </div>
                </div>
            </div>
            <div class="perfil-usuario-body">
                <div class="perfil-usuario-bio">
                    <h3 class="titulo"><?php echo $datosUsuario['name'] . ' ' . $datosUsuario['surname']; ?></h3>
                    <p class="texto">Correo Electrónico: <?php echo $datosUsuario['email']; ?></p>
                    <p class="texto">Fecha de Nacimiento: <?php echo $datosUsuario['birthdate']; ?></p>
                    <p class="texto">Dirección: <?php echo $datosUsuario['direccion']; ?></p>
                    <p class="texto">Teléfono: <?php echo $datosUsuario['telefono']; ?></p>
                    <p class="texto">Ocupación: <?php echo $datosUsuario['ocupacion']; ?></p>
                    <p class="texto">Estado: <?php echo $datosUsuario['estado']; ?></p>
                </div>
            </div>
            <button><a href="inicio.html">Atras</a></button>
            <button><a href="crud.php">Editar</a></button>
        </section>
    </body>
    </html>
    <?php
} else {
    echo "No se encontraron datos del usuario.";
}
?>
    <!--====  End of html  ====-->

<!--=============================
redes sociales fijadas en pantalla
No es necesario que copies esto!
==============================-->
<style>
.mensaje a {
    color: inherit;
    margin-right: .5rem;
    display: inline-block;
}
.mensaje a:hover {
    color: #309B76;
    transform: scale(1.4)
}
</style>

<!--====  End of tarjeta  ====-->
</body>

</html>    