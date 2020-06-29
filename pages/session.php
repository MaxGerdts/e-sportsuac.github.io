<?php
include 'config.php';
session_start();
$user_check = $_SESSION['autorizado'];
   if($user_check = false){
      header("location:login.php");
      die();
   }

 ?>
