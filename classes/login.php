<?php
  include_once 'server.class.php';
  session_start();

  $msg = (isset($_GET['msg'])) ? $_GET['msg'] : "";
  $name = (isset($_SESSION['name'])) ? $_SESSION['name'] : "";
  $out = "";

  if(isset($_POST['submit'])){
    if((isset($_POST['name']) && isset($_POST['pass']))){
      $login_name = $_POST['name'];
      $password = $_POST['pass'];

      $server = new Server();

      $server->loginUser($login_name, md5($password));
    }
  }else{
    $out .= $msg . "<br>";
    $out .= "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>";
    $out .= "<input type='text' name='name' placeholder='Username' value='".$name."' autofocus><br>";
    $out .= "<input type='password' name='pass' placeholder='Password' value=''><br>";
    $out .= "<input type='submit' name='submit'><br>";
    $out .= "</form>";
    $out .= "<a href='register.php'>Register</a>";
  }

  echo $out;
