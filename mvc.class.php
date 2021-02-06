<?php
include_once '../includes/config.inc.php';

interface Mvc {
	public function connect();
  public function select($on, $what = "", $where = "", $params = [], $types = "", $by = "");
  public function create_table($on, $what="");
  public function create_db($on);
  public function insert($on, $what = "", $where = "", $params = []);
  public function update($on, $what = "", $where = "", $params = []);
  public function drop_db($on);
  public function drop_table($on);
  public function delete($on, $where = "", $params = []);
  public function close();
}

abstract class DB implements Mvc {
  // ~/~/~/ Set global database credentials @ "../config.inc.php"
  // ~/~/~/ Set global variables HOST, USER, PASS, SERVER & GAME in "../config.inc.php"
	const HOST = HOST;
	const USER = USER;
	const PASS = PASS;
  protected $db;
  private $conn;
  private $res;
  private $sql;
  private $do;
  private $on;
  private $what = "";
  private $where = "";
  private $by = "";
  private $params = array();
  private $types = "";

  // ~/~/~/ public access property
  public $data;

  public function connect(){
    //set property $conn to a new mysqli object
    $this->conn = new mysqli(self::HOST, self::USER, self::PASS, $this->db);

    //pass the object
    return $this->conn;
  }

  protected function sqlize(){
    //set property $sql to SQL executable string
    $this->sql = $this->do . $this->on . $this->what . $this->where . $this->by;

    //return SQL executable string
    return $this->sql;
  }

  protected function query(){
    //create bound prepared statement character string
    $this->prepared_string($this->params);
    //set property $res to mysqli response object
    $this->res = (!empty($this->params) && !empty($this->types)) ? $this->prepared_query()->get_result() : $this->conn->query($this->sql);

    //pass the object
    return $this->res;
  }

  function prepared_string($types){
    $str = "";
    //iterate over each index of $this->types[...]
    for($i=0; $i<count($types); $i++){
      switch(gettype($types[$i])){
        case "string":
          $str .= "s";
          break;
        case "integer":
          $str .= "i";
          break;
        case "blob":
          $str .= "b";
          break;
        case "double":
          $str .= "d";
          break;
      }
    }
    $this->types = $str;

    //return bound prepared statement character string
    return $this->types;
  }

  protected function prepared_query(){
    //set property $res to mysqli prepared object
    $this->res = $this->conn->prepare($this->sql);
    //bind to mysqli prepared object
    //E.G. - bind_param("sib", ["String", 153, True]);
    $this->res->bind_param($this->types, ...$this->params);
    //execute bound mysqli prepared object
    unset($this->types);
    $this->res->execute();

    //return mysqli response object
    return $this->res;
  }

  protected function format(){
    if(!empty($this->res) && !empty($this->res->num_rows)){
      if($this->res->num_rows > 0){
        //create multi-dimensional array
        $arr = array();
        while($data = $this->res->fetch_assoc()){
          $arr[] = $data;
        }
        // ~/~/~/ set public property $data to multi-dimensional array ~/~/~/
        $this->data = $arr;

        //return multi-dimensional array
        return $this->data;
      }
    }
  }

  protected function run(){
      // ~/~/~/ Set global database credentials @ "
      // ~/~/~/ Set global variables HOST, USER, PASS, SERVER & GAME in "../config.inc.php"
      //set property $conn mysqli connection object
      $this->conn = $this->connect();
      //set property $sql to SQL executable string
      $this->sql = $this->sqlize();
      //just to see
      $out = $this->sql . "<br>";
      //set property $res to mysqli response obect
      $this->query();
      //set public $data property to either associative array or multi-dimension if mysqli result num_rows == 1
      if(!empty($this->res) && !empty($this->res->num_rows)){
        $this->data = $this->format();
      }
      //close the connection
      echo $out;
      $this->close();
  }

  public function close(){
    $this->conn->close();
  }

  // ~/~/~/ PUBLIC DATABASE METHODS: CRUD

  public function select($on, $what = "", $where = "", $params = [], $types = "", $by = ""){
    $what = empty($what) ? "*" : $what;
    $this->do = "SELECT " . $what;
    $this->on = " FROM " . $on;
    $this->where = empty($where) ? "" : " WHERE " . $where;
    $this->by = empty($by) ? "" : " ORDER BY " . $this->by;
    $this->params = $params;
    $this->types = $types;
    $this->run();
  }

  public function create_table($on, $what="") {
      $this->do = "CREATE TABLE ";
      $this->on = "`" . $on . "`";
      $this->what = " " . $what;
      $this->run();
  }

  public function create_db($on){
    $this->do = "CREATE DATABASE ";
    $this->on = "`" . $on . "`";
    $this->run();
  }

  public function insert($on, $what = "", $where = "", $params = []){
    $this->do = "INSERT INTO ";
    $this->on = "`" . $on . "`";
    $this->what = " " . $what;
    $this->where = empty($where) ? "" : " VALUES " . $where;
    $this->params = $params;
    $this->run();
  }

  public function update($on, $what = "", $where = "", $params = []){
    $this->do = "UPDATE ";
    $this->on = "`" . $on . "`";
    $this->what = empty($what) ? "" : " SET " . $what;
    $this->where = empty($where) ? "" : " WHERE " . $where;
    $this->params = $params;
    $this->run();
  }

  public function drop_db($on){
    $this->do = "DROP DATABASE IF EXISTS ";
    $this->on = "`" . $on . "`";
    $this->run();
  }

  public function drop_table($on){
    $this->do = "DROP TABLE IF EXISTS ";
    $this->on = "`" . $on . "`";
    $this->run();
  }

  public function delete($on, $where = "", $params = []){
    $this->do = "DELETE FROM ";
    $this->on = "`" . $on . "`";
    $this->what = " ";
    $this->where = empty($where) ? "" : "WHERE " . $where;
    $this->params = $params;
    $this->run();
  }

}
