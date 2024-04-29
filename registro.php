<?php

include('conexion_be.php');

$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$status = $_POST['status'];
$birthdate = $_POST['birthdate'];
$password = $_POST['password'];

$passCrypted = password_hash($password, PASSWORD_BCRYPT);

// Error handling (optional but recommended)
if (!$passCrypted) {
  echo "Error: Password hashing failed!, 400";
  exit(); // Stop script execution on error
}

$conecta = conn();

$sql = "INSERT INTO register(name, surname, email, status, birthdate, password) 
VALUES ('$name', '$surname', '$email', '$status', '$birthdate', '$passCrypted')";

$resultado = mysqli_query($conecta, $sql);

if ($resultado) {
  // Registration successful, redirect to inicio.html
  header("Location: inicio.html",200);
  exit(); // Stop script execution after redirect
} else {
  // Registration failed, handle error (e.g., display error message)
  echo "Error: Registration failed! Please try again. ",400;
}

mysqli_close($conecta); // Close the connection (good practice)



