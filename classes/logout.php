<?php
  include_once 'server.class.php';
  session_start();

  $debug = 1;
  if ($debug) {
  $read = new server();
  $read->select('accounts');
  $data = $read->data;
  //print_r($data);
  foreach ($data as $val) {
      //echo print_r($val) . '<br>';
      if ($val['id'] == $_SESSION['id'] && $val['session_id'] == $_SESSION['key']) {
        $_SESSION['key'] = "";
      }
    }
    header('Location: login.php');
  }
