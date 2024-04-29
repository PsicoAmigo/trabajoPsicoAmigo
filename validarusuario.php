<?php

include('conexion_be.php');

$USUARIO=$_POST['email'];
$PASSWORD=$_POST['password'];

//$consulta="SELECT*FROM usuarios where email='$USUARIO' and password='$PASSWORD'";
$consulta="SELECT*FROM register where email='$USUARIO'";
$conecta=conn();
$resultado=mysqli_query($conecta, $consulta);
$dato = $resultado->fetch_assoc();

$filas=mysqli_num_rows($resultado);

if($filas == 1){

    if (password_verify($PASSWORD, $dato['password'])) {
        header("location:inicio.html",200);
    } else {
        echo "Los datos ingresado son invalidos.",400;
    }
}else{
    include("index.php",400); //400
    echo "se fue por el else.";
}
//mysqli_free_result($resultado);
mysqli_close($conecta);

?>