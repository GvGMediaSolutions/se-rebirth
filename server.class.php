<?php
include_once 'mvc.class.php';

class Server extends Db {
  public function __construct(){
    //$this->create_db(SERVER);
    $this->db = SERVER;
    //$this->create_table("daily_tips", " (`tip_id` int(4) NOT NULL auto_increment, `tip_content` text NOT NULL, PRIMARY KEY  (`tip_id`)) ENGINE=MyISAM");
    //$this->insert("daily_tips", "(`tip_id`, `tip_content`)", "(?, ?)", array(1, 'To customise your SE experiance, try playing with some of the options on the <b class=b1>Options</b> Page.'));
    //$this->update("daily_tips", "`tip_id`=?, `tip_content`=?", "(`tip_id`=?)", array(2, 'You can change your colour scheme at any time from the options page.<br>There are plenty to choose from.', 1));
    //$this->drop_db(SERVER);
    //$this->drop_table("daily_tips");
    //$this->delete("daily_tips", "(`tip_id`=?)", array(2));
    //$this->select("user_accounts", "*", "login_id=? AND login_name=?", array(1, "Admin"));
    //$this->insert("user_accounts", "(`login_id`, `login_name`)", "(?, ?)", array(3, "Test"));
    //$this->select("user_accounts", "*");
  }

  public function destroy(){
    $this->drop_db(GAME);
    $this->drop_db(SERVER);
    $this->db = "";
  }

  public function makeNew(){
    $this->db = "";
    $this->create_db(SERVER);
    $this->db = SERVER;
    $this->create_table("user_accounts", " ( `id` INT(4) NOT NULL AUTO_INCREMENT , `name` VARCHAR(32) NOT NULL , PRIMARY KEY (`id`)) ENGINE = InnoDB");
    $this->makeUser('Owner');
  }

  public function makeUser($name){
    $this->insert("user_accounts", "(`name`)", "(?)", array($name));
  }
}

$env = new Server();
$env->destroy();
$env->makeNew();
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
