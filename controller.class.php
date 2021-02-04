<?php
include_once 'model.class.php';

interface Controller {
  public function close();
}

abstract class Dbi extends Db implements Controller {
  private $sql;

  protected function query($sql){
    $this->conn->query($sql);
  }

  public function close(){
    $this->conn->close();
  }

}

class Create_Db extends Dbi {
  public function __construct($name){
    $this->sql = "DROP DATABASE IF EXISTS " . $name . "; CREATE DATABASE " . $name;
    $this->conn = $this->connect();
    $this->query($this->sql);
    $this->close();
  }

}

class Create_Table extends Dbi {
  public function __construct($sql){
    $this->sql = $sql;
    $this->conn = $this->connect();
    $this->query($this->sql);
    $this->close();
  }

}


class Drop_Db extends Dbi {
  public function __construct($name){
    $this->sql = "DROP DATABASE IF EXISTS " . $name;
    $this->conn = $this->connect();
    $this->query($this->sql);
    $this->close();
  }

}

class Drop_Table extends Dbi {
  public function __construct($name){
    $this->sql = "DROP TABLE IF EXISTS " . $name;
    $this->conn = $this->connect();
    $this->query($this->sql);
    $this->close();
  }
}

$sql = "CREATE TABLE `daily_tips` (`tip_id` int(4) NOT NULL auto_increment, `tip_content` text NOT NULL, PRIMARY KEY  (`tip_id`)) ENGINE=MyISAM;";
$a = new Create_Table($sql);
