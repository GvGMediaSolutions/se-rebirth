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
      if ($val['id'] == $_SESSION['id']) {

        $img = new Server();
        $img->select("account_images", "*", array('account_id'), array($val['id']));
        $encoded_img = $img->data[0]['data'];
        header('Content-Type: ' . $img->data[0]['type']);
        echo $encoded_img;
      }
    }
  }
