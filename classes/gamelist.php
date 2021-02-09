<?php

  /// ~/~/~/ TO DO: ADD SESSION AUTHENTICATION
  $id = ($_GET['id']) ? $_GET['id'] : "";
  $msg = ($_GET['msg']) ? $_GET['msg'] : "";

  echo $msg . "[".$id."]";
