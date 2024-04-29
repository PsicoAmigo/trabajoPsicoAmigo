<?php

include('conexion_be.php');

$name = $_POST['name'];
$surname = $_POST['surname'];
$email = $_POST['email'];
$status = $_POST['status'];
$birthdate = $_POST['birthdate'];
$password = $_POST['password'];

// Validar el formato del correo electrónico
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
  http_response_code(400);
  echo "Error: El correo electrónico ingresado no es válido.";
  exit();
}

// Verificar si el correo ya está registrado
$conecta = conn();
$sql_check_email = "SELECT * FROM register WHERE email='$email'";
$result_check_email = mysqli_query($conecta, $sql_check_email);
if (mysqli_num_rows($result_check_email) > 0) {
  http_response_code(400);
  echo "Error: El correo electrónico ya está registrado.";
  exit();
}

// Validar el formato del password
if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/', $password)) {
  http_response_code(400);
  echo "Error: El password debe tener al menos 8 caracteres, una mayúscula, un valor alfanumérico y un carácter especial.";
  exit();
}

$passCrypted = password_hash($password, PASSWORD_BCRYPT);

// Error handling (optional but recommended)
if (!$passCrypted) {
  http_response_code(500);
  echo "Error: Password hashing failed!";
  exit(); // Stop script execution on error
}

$sql = "INSERT INTO register(name, surname, email, status, birthdate, password) 
VALUES ('$name', '$surname', '$email', '$status', '$birthdate', '$passCrypted')";

$resultado = mysqli_query($conecta, $sql);

if ($resultado) {
  // Registration successful, redirect to inicio.html
  header("Location: inicio.html", true, 200);
  exit(); // Stop script execution after redirect
} else {
  // Registration failed, handle error (e.g., display error message)
  http_response_code(500);
  echo "Error: Registration failed! Please try again.";
  exit();
}

mysqli_close($conecta); // Close the connection (good practice)