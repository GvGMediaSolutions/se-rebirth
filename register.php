<?php
  include_once 'server.class.php';

  if((isset($_GET['name']) && isset($_GET['pass']) && $_GET['pass2'])){
    $name = $_GET['name'];
    $pass = $_GET['pass'];
    $pass2 = $_GET['pass2'];
    $server = new Server();
    $server->makeUser($name, $pass);
    $out = "Created new account! As" . $name;
  }else{
    $out = "Complete all of the fields!";
  }

  echo $out;
