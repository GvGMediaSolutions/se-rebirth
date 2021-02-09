<?php
  include_once 'server.class.php';
  session_start();

  $out = "";
  if(isset($_SESSION['id']) && isset($_SESSION['name'])){
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];

    $out .= "Logged in as: " . $name." - [".$id."]<br><a href='register.php'>Register</a><br><a href='login.php'>Login</a><br>";
  }else{
    header('Location: login.php');
  }

  echo $out;
