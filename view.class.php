<?php
include_once 'model.class.php';

interface View {
	public function close();
}

abstract class Endpoint extends Db implements View{
  // public access property
  public $data;

  protected $sql;
  protected $params = array();
  protected $types = "";

  protected function sqlize($from, $what = "", $where = ""){
    $what = empty($what) ? "*" : $what;
    $this->sql = "SELECT " . $what . " FROM " . $from;
    $this->sql .= empty($where) ? "" : " WHERE " . $where;
    return $this->sql;
  }

  protected function query($sql, $params = [], $types = ""){
    // set property $res to mysqli response object
    $this->res = (!empty($params) && !empty($types)) ? $this->prepared_query($sql, $params, $types)->get_result() : $this->conn->query($sql);

    return $this->res;
  }

  protected function format(){
    if($this->res->num_rows > 0){
      //create multi-dimensional array
      $arr = array();
      while($data = $this->res->fetch_assoc()){
        $arr[] = $data;
      }
      //set property $data to multi-dimensional array
      $this->data = $arr;

      //return multi-dimensional array
      return $this->data;
    }
  }

  public function close(){
    $this->conn->close();
  }

}

class Dbh extends Endpoint {
  protected $from;
  protected $what = "";
  protected $where = "";

  public function __construct(){
    //set property $conn to returned mysqli object through Db::connect() call
    $this->conn = $this->connect();

    //set property $sql to assembled sql statement
    $this->sql = $this->sqlize($this->from, $this->what, $this->where);

    //set property $res to mysqli response object

    //SYNTAX: query proxy method
    //$this->res = $this->query($this->sql);

    //SYNTAX: prepared statement proxy method
    $this->res = $this->query($this->sql, $this->params, $this->types);

    //set public $data property to either associative array or multi-dimension if mysqli result num_rows == 1
    $this->data = $this->res->num_rows == 1 ? $this->res->fetch_assoc() : $this->format();
    //close the connection
    $this->close();
  }

}

class Users extends Dbh {
  public function __construct(){
    $this->from = "user_accounts";
    parent::__construct();
  }
}

class User extends Dbh {
  public function __construct($login_id){
    $this->params = array($login_id);
    $this->types = "i";
    $this->from = "user_accounts";
    $this->what = "*";
    $this->where = "login_id=?";
    parent::__construct();
  }
}

$user = new User(1);

foreach($user->data as $key => $val){
  echo $key . ": " . $val . "<br>";
}
echo "<br>";

$users = new Users();

for($i=0; $i<count($users->data); $i++){
  //$Dbh->data[$i][...]
  foreach($users->data[$i] as $key => $val){
    echo $key . ": " . $val . "<br>";
  }
  echo "<br>";
}
