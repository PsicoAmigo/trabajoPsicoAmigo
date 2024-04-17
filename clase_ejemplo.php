<?php 

class basedatos {
    public function conn(){
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

    public function consulta($query){
        //$consulta="SELECT*FROM usuarios where email='$USUARIO' and password='$PASSWORD'";
        //$consulta="SELECT*FROM register where email='$USUARIO'";
        $conecta=conn();
        $resultado=mysqli_query($conecta, $query);
        $dato = $resultado->fetch_assoc();
        return $dato;
    }
}