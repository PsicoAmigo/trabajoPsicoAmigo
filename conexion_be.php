<?php 

    //conexion al registro
    function conn(){
        $hostname="localhost";
        $usuariodb="root";
        $passworddb="";
        $dbname="psicoamigo";
    
        $conectar=mysqli_connect($hostname, $usuariodb, $passworddb, $dbname);
        
        if(!$conectar){
            echo ("No conecte");
        }

        return $conectar;
    }

    

?>

