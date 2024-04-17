<?php

include('conexion_be.php');

$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$status = $_POST['status'];
$birthdate = $_POST['birthdate'];
$password = $_POST['password'];
$passCrypted = password_hash($password, PASSWORD_BCRYPT);

echo "los datos son los siguientes";
echo "'$name', '$surname', '$email','$status''$birthdate','$password'";

$conecta=conn();

$sql="INSERT INTO register( name, surname, email, status, birthdate, password) 
VALUES ('$name', '$surname', '$email', '$status', '$birthdate', '$passCrypted')";

$resultado=mysqli_query($conecta , $sql);  


/*if($conecta and $sql){
    header("location:/psicoamigo/login-register/inicio.html"),200;
    }else{
        echo"error en la consulta", mysqli_error($conecta),400;
}
*/
?>