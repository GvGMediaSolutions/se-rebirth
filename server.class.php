<?php
include_once 'mvc.class.php';

class Server extends Db {
  public function __construct(){
    //$this->create_db(SERVER);
    $this->db = SERVER;
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
/* ~/~/~ TO DO
SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode =
'NO_AUTO_VALUE_ON_ZERO';
SET NAMES utf8mb4;
*/

$a = new Server();
//$a->drop_table("accounts");
//$a->create_table("accounts", "(`id` int(11) NOT NULL AUTO_INCREMENT, `login_name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL, `password` varchar(32) NOT NULL, `date_created` varchar(64) NOT NULL, `times_logged_in` int(10), `last_login` varchar(64), `ip_address` varchar(64), `banned` int(1), `status` varchar(32), `session_id` varchar(32), `games_joined` int(6), `msg_signature` varchar(255), `tokens` int(11), `player_image_path` varchar(255), `total_forum_posts` int(11), `forum_likes` int(11), `forum_dislikes` int(11), PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");


/* ~/~/~ TEST AREA

//$env = new Server();
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
