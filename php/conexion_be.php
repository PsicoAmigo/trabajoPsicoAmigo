<?php 

    $conexion =mysqli_connect("localhost", "root","","psicoamigo");


    //conexion al registro
    function conn(){
        $hostname="localhost";
        $usuariodb="root";
        $passworddb="";
        $dbname="psicoamigo";
    
        $conectar=mysqli_connect($hostname, $usuariodb, $passworddb, $dbname);
    return $conectar;
    }

?>