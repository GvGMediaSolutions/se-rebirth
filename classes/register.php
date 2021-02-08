<?php
  include_once 'server.class.php';

  if((isset($_GET['name']) && isset($_GET['pass']) && isset($_GET['pass2']))){
    $login_name = $_GET['name'];
    $password = $_GET['pass'];
    $password2 = $_GET['pass2'];

    $server = new Server();

    $server->registerUser($login_name, $password, $password2);
  }

  //echo $out;
