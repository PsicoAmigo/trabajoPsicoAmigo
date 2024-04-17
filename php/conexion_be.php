<?php 

    $conexion =mysqli_connect("localhost", "root","","login_rigister_db");


    //conexion al registro
    function conn(){
        $hostname="localhost";
        $usuariodb="root";
        $passworddb="";
        $dbname="login.rigister.db";
    
        $conectar=mysqli_connect($hostname, $usuariodb, $passworddb, $dbname);
    return $conectar;
    }

?>