<?php
include_once '../includes/config.inc.php';

interface Model {
	public function connect();
}

abstract class DB implements Model {

  // Set you database credentials here
	const HOST = HOST;
	const USER = USER;
	const PASS = PASS;
	const DB = DB;

  //name of game (to be created)
  const SERVER = SERVER;

  //properties
  private $conn;
  // mysqli response object
  private $res;

  public function connect(){
    //set property $conn to a new mysqli object
    $this->conn = new mysqli(self::HOST, self::USER, self::PASS, self::DB);

    //pass the object
    return $this->conn;
  }

  protected function prepared_query($sql, $params = [], $types = ""){
    //either use set parameter $types or default to prepared string type "s" per parameter $param size
    $types = $types ?: str_repeat("s", count($params));

    //set property $res to mysqli prepared object
    $this->res = $this->conn->prepare($sql);
    //bind to mysqli prepared object
    //E.G. - bind_param("sib", ["String", 153, True]);
    $this->res->bind_param($types, ...$params);
    //execute bound mysqli prepared object
    $this->res->execute();

    return $this->res;
  }

}
