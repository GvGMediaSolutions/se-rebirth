<?php
//TO DO: Prepared Statements failing
//Otherwise fully functional
include_once 'model.class.php';

interface Controller {
  public function close();
}

abstract class Endpoint extends Db implements Controller {

  protected $sql;
  protected $params = array();
  protected $types = "";

  protected function query($sql, $params = [], $types = ""){
    (!empty($params) && !empty($types)) ? $this->prepared_query($sql, $params, $types) : $this->conn->query($sql);
  }

  public function close(){
    $this->conn->close();
  }

}

class Dbi extends Endpoint {
  protected $do;
  protected $on;
  protected $what = "";
  protected $where = "";

  public function __construct($do, $on, $what = "", $where = ""){
    $this->conn = $this->connect();
    $this->sql = $do . $on . $what . $where;
    echo $this->sql;
    $this->query($this->sql, $this->params, $this->types);
    $this->close();
  }
}

class Create_Db extends Dbi {
  public function __construct($on){
    $this->do = "CREATE DATABASE ";
    $this->on = $on;
    parent::__construct($this->do, $this->on);
  }

}

class Create_Table extends Dbi {
  public function __construct($on){
    $this->do = "CREATE TABLE ";
    $this->on = "`" . $on . "`";
    $this->what = " (`tip_id` int(4) NOT NULL auto_increment, `tip_content` text NOT NULL, PRIMARY KEY  (`tip_id`)) ENGINE=MyISAM";
    parent::__construct($this->do, $this->on, $this->what);
  }

}

class Insert extends Dbi {
  public function __construct($on){
    $this->do = "INSERT INTO ";
    $this->on = "`" . $on . "`";
    $this->what = " (`tip_id`, `tip_content`)";
    $this->where = " VALUES (?, ?)";
    $this->params = array(1, 'To customise your SE experiance, try playing with some of the options on the <b class=b1>Options</b> Page.');
    $this->types = "is";
    parent::__construct($this->do, $this->on, $this->what, $this->where);
  }
}

class Update extends Dbi {
  public function __construct($on){
    $this->do = "UPDATE ";
    $this->on = "`" . $on . "`";
    $this->what = " SET `tip_id`=?, `tip_content`=?";
    $this->where = " WHERE `tip_id`=?";
    $this->params = array(2, 'You can change your colour scheme at any time from the options page.<br>There are plenty to choose from.', 1);
    $this->types = "isi";
    parent::__construct($this->do, $this->on, $this->what, $this->where);
  }
}


class Drop_Db extends Dbi {
  public function __construct($on){
    $this->do = "DROP DATABASE IF EXISTS ";
    $this->on = $on;
    parent::__construct($this->do, $this->on);
  }

}

class Drop_Table extends Dbi {
  public function __construct($on){
    $this->do = "DROP TABLE IF EXISTS ";
    $this->on = $on;
    parent::__construct($this->do, $this->on);
  }
}

class Delete extends Dbi {
  public function __construct($on){
    $this->do = "DELETE FROM ";
    $this->on = "`" . $on . "`";
    $this->what = " ";
    $this->where = "WHERE `tip_id`=2";
    //$this->params = array(2);
    //$this->types = "i";
    parent::__construct($this->do, $this->on, $this->what, $this->where);
  }
}


$a = new Drop_Table("daily_tips");
//$b = new Create_Table("daily_tips");
//$c = new Insert("daily_tips");
//$d = new Update("daily_tips");
//$e = new Delete("daily_tips");
//$f = new Drop_Table("daily_tips");
