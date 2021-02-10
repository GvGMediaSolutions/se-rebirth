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
        //get uploaded file blob
        if(isset($_POST['submit'])){
          if(count($_FILES) > 0){
            if(getimagesize($_FILES['plyr_img']['tmp_name'])){
              $server = new Server();
              $server->select("account_images", "*", array('account_id'), array($val['id']));
              $imgData = file_get_contents($_FILES['plyr_img']['tmp_name']);
              $imageProperties = getimageSize($_FILES['plyr_img']['tmp_name']);
              $table = "account_images";
              $fields = array("type", "data", "account_id");
              $values = array($imageProperties['mime'], $imgData, $val['id']);
              if(empty($server->data[0])){
                $server->insert($table, $fields, $values);
              }else{
                $server->update($table, array('type', 'data'), array('account_id'), $values);
              }
              header('Location: gamelist.php');
              //header('Content-type: '.$imageProperties['mime']);
              //echo $imgData;
            }else{
              echo "not file";
            }
          }else{
            echo "0 files";
          }
        }
      }
  }
}
