<?php
session_start();
// initializing variables
$username = "";
$email    = "";
$errors = array(); 
$_SESSION['loggin']=false;
$_SESSION['supervisor']=false;

// connect to the database
$db = mysqli_connect('localhost', 'root', '','hostel');

if (isset($_POST['login_user'])) {
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $password = mysqli_real_escape_string($db, $_POST['password']);
    $twoFa = mysqli_real_escape_string($db, $_POST['_2fa_token']);
  
    if (empty($username)) {
        array_push($errors, "Username is required");
    }
    if (empty($password)) {
        array_push($errors, "Password is required");
    }
    if (empty($twoFa)) {
        array_push($errors, "2FA code is required");
    }
  
    if (count($errors) == 0) {
        $password = md5($password);
        $query = "SELECT * FROM supervisors WHERE username='$username' AND password='$password' LIMIT 1;";
        $results = mysqli_query($db, $query);
        if (mysqli_num_rows($results) == 1) {
          $_SESSION['username'] = $username;
          $_SESSION['success'] = "You are now logged in";
          $_SESSION['loggin']=true;
          $_SESSION['supervisor']=true;
          header('location: dashboard.php');
        }else {
            array_push($errors, "Wrong username/password combination");
        }
    }
  }
