<?php

include('conexion_be.php');

$USUARIO=$_POST['email'];
$PASSWORD=$_POST['password'];

//$consulta="SELECT*FROM usuarios where email='$USUARIO' and password='$PASSWORD'";
$consulta="SELECT * FROM register WHERE email='$USUARIO'";
$conecta=conn();
$resultado=mysqli_query($conecta, $consulta);
$dato = $resultado->fetch_assoc();

$filas=mysqli_num_rows($resultado);

if($filas == 1){

    if (password_verify($PASSWORD, $dato['password'])) {
        // Iniciar sesión y almacenar ID
        session_start();
        $_SESSION['usuario_id'] = $dato['id']; // Suponiendo que "id" es la columna en la tabla que almacena el ID del usuario
        header("location:inicio.html",200);
    } else {
        echo "Los datos ingresados son inválidos.",400;
    }
}
//mysqli_free_result($resultado);
mysqli_close($conexion);

?>