<?php
  include('connection.php');
  include_once("./services/basic_functions.php");

  if(isset($_POST['submit'])){
      $name=$_POST['name'];
      $phone=$_POST['phone'];
      $email=$_POST['email'];
      $subject=$_POST['subject'];
      $message=$_POST['message'];

      $query= "insert into queries
      (name,phone,email,subject,message) 
      values ('$name','$phone','$email','$subject','$message')";
      
      if(mysqli_query($conn,$query) or die(mysqli_error($conn)))
      JSFunctions::alert("REQUEST SENT SUCESSFULLY !!!!");
      else
      JSFunctions::alert("REQUEST NOT SENT!!!!");
  }
