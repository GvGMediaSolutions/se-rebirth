<?php
include_once 'mvc.class.php';

class Game extends Db {
  protected $table = "";
  protected $fields = [];
  protected $values = [];

  public function __construct($db = ""){
    //$this->create_db(SERVER);
    $this->db = !empty($db) ? $db : GAME;
  }

  public function destroy(){
    $this->drop_db(GAME);
    $this->db = "";
  }

  public function makeNew(){
    $this->db = "";
    $this->drop_db(GAME);
    $this->create_db(GAME);
    $this->db = GAME;
    $this->makeTableAccounts();
  }

  // ~/~/~/ READ ME: Set $this->table to Game Database Name && Set $str to Game Database Creation SQL
  public function makeTableAccounts(){
    $this->table = "";
    $str = "";
    $this->drop_table($this->table);
    $this->create_table($this->table, $str);
    // ~/~/~/
    //$this->makeUser('Owner', 'password', 1);
    //$this->makeUser('Admin', 'password', 2);
    //$this->makeUser('Test', 'password');
  }

  // ~/~/~/ READ ME: Set $this->table to Game Database Name $$ Set $this->fields to array of field names && Set $this->values to array of values
  public function makeUser($login_name, $password, $status = 0){
    $this->table = "";
    $this->fields = array();
    $this->values = array();
    $this->insert($this->table, $this->fields, $this->values);
  }
}

$a = new Game();
// ~/~/~/ READ ME: Drops ALL game databses and Drops root DATABASE
$a->destroy();
//Creates a brand new root database and creates the necessary tables
$a->makeNew();

//$this->create_table("daily_tips", " (`tip_id` int(4) NOT NULL auto_increment, `tip_content` text NOT NULL, PRIMARY KEY  (`tip_id`)) ENGINE=MyISAM");
//$this->create_table("(str)$on, "(str)$what");

// ~/~/~/ FORMATTING ABSTRACTED!

//$this->update("daily_tips", array("tip_id", "tip_content"), array("tip_id"), array(2, 'You can change your colour scheme at any time from the options page.<br>There are plenty to choose from.', 1));
//$this->update("(str)$on", "(array)$what", "(array)$where", (array)$params);

//$this->drop_db(SERVER);
//$this->drop_db("(str)$on");

//$this->drop_table("daily_tips");
//$this->drop_table("(str)$on");

//$this->delete("daily_tips", "tip_id", array(2));
//$this->delete("(str)$on", "(str)$where", (array)$params);

//$this->select("user_accounts", "*", array("id", "name"), array(1, "Owner"));
//$this->select("(str)$on", "(str)$what", "(array)$where", (array)$params);

//$this->insert("user_accounts", array("id", "name"), array(3, "Test"));
//$this->insert("(str)$on", "(array)$what", (array)$params);

/* ~/~/~ TO DO
SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode =
'NO_AUTO_VALUE_ON_ZERO';
SET NAMES utf8mb4;
*/

/* ~/~/~ TEST AREA

//$env = new Game();
//$env->destroy();
//$env->makeNew();
/*
foreach($env->data[0] as $key => $val){
  echo $key . ": " . $val . "<br>";
}
echo "<br>";
*/

/*
for($i=0; $i<count($env->data); $i++){
  foreach($env->data[$i] as $key => $val){
    echo $key . ": " . $val . "<br>";
  }
  echo "<br>";
}
*/
