<?php
  include_once 'server.class.php';
  
  $msg = ($_GET['msg']) ? $_GET['msg'] : "";
  $out = "";

  if(isset($_POST['submit'])){
    if((isset($_POST['name']) && isset($_POST['pass']))){
      $login_name = $_POST['name'];
      $password = $_POST['pass'];

      $server = new Server();

      $server->loginUser($login_name, $password);
    }
  }else{
    $out .= $msg . "<br>";
    $out .= "<form action='login.php' method='post'>";
    $out .= "<input type='text' name='name' placeholder='Username' autofocus><br>";
    $out .= "<input type='password' name='pass' placeholder='Password'><br>";
    $out .= "<input type='submit' name='submit'></form>";
    $out .= "</form>";
  }

  echo $out;
