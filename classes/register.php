<?php
  include_once 'server.class.php';

  $msg = (isset($_GET['msg'])) ? $_GET['msg'] : "";
  $out = "";

  if(isset($_POST['submit'])){
    if((isset($_POST['name']) && isset($_POST['pass']) && isset($_POST['pass2']))){
      $login_name = $_POST['name'];
      $password = $_POST['pass'];
      $password2 = $_POST['pass2'];

      $server = new Server();

      $server->registerUser($login_name, $password, $password2);
    }
  }else{
    $out = $msg . "<br>";
    $out .= "<form action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "' method='post'>";
    $out .= "<input type='text' name='name' placeholder='Username' autofocus><br>";
    $out .= "<input type='password' name='pass' placeholder='Password'><br>";
    $out .= "<input type='password' name='pass2' placeholder='Password Again'><br>";
    $out .= "<input type='submit' name='submit'>";
    $out .= "</form>";
  }

  echo $out;
