<?php
//TO DO: STILL GOT WORK TO DO HERE
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

class Insert extends Dbi {
  public function __construct($sql, $params = [], $types = ""){
    $this->sql = $sql;
    $this->conn = $this->connect();
    $this->prepared_query($this->sql, $params, $types);
    $this->close();
  }
}

class Update extends Dbi {
  public function __construct($sql, $params = [], $types = ""){
    $this->sql = $sql;
    $this->conn = $this->connect();
    $this->prepared_query($this->sql, $params, $types);
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

class Delete extends Dbi {
  public function __construct($sql, $params = [], $types = ""){
    $this->sql = $sql;
    $this->conn = $this->connect();
    $this->prepared_query($sql, $params, $types);
    $this->close();
  }
}

//TO DO: abstract away table name
//$sql = "CREATE TABLE `daily_tips` (`tip_id` int(4) NOT NULL auto_increment, `tip_content` text NOT NULL, PRIMARY KEY  (`tip_id`)) ENGINE=MyISAM;";
//$a = mew Create_Table($sql)

//TO DO: abstract away table name
//$sql = "INSERT INTO `daily_tips` (`tip_id`, `tip_content`) VALUES (?, ?)";
//$params = array(1, 'To customise your SE experiance, try playing with some of the options on the <b class=b1>Options</b> Page.');
//$types = "is";
//$a = new Insert($sql, $params, $types);

//TO DO: abstract away table name
$sql = "UPDATE `daily_tips` SET `tip_id`=?, `tip_content`=? WHERE `tip_id`=?";
$params = array(2, 'You can change your colour scheme at any time from the options page.<br>There are plenty to choose from.', 1);
$types = "isi";
$a = new Update($sql, $params, $types);

//$sql = "DELETE FROM `daily_tips` WHERE `tip_id`=?";
//$params = array(2);
//$types = "i";
//$a = new DELETE($sql, $params, $types);
