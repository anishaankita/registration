<?php
   session_start();
   $username = filter_input(INPUT_POST, 'username');
   $email = filter_input(INPUT_POST, 'email');
   
   $password_1 = filter_input(INPUT_POST, 'password_1');
   $password_2 = filter_input(INPUT_POST, 'password_2');
   $errors = array();

   $db = mysqli_connect('localhost', 'root', '', 'registration');

   if (isset($_POST['register'])) {
   	$username = mysqli_real_escape_string($db, $_POST['username']);
   	$email = mysqli_real_escape_string($db, $_POST['email']);
   	$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
   	$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
   }

   if (empty($username)) {
   	array_push($errors, "Username is required");
   }

   if (empty($email)) {
   	array_push($errors, "Email is required");
   }

   if (empty($password_1)) {
   	array_push($errors, "Password is required");
   }

   if ($password_1 != $password_2) {
   	array_push($errors, "The two password do not match");
   }

   if (count($errors) == 0) 
   	$password = md5($password_1);
   	$sql = "INSERT INTO users (username , email, password) 
   	        VALUES ('$username', '$email', '$password_1')";
   	mysqli_query($db, $sql);
?>