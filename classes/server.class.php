<?php
include_once 'mvc.class.php';

class Server extends Db {
  protected $table = "";
  protected $str = "";
  protected $fields = [];
  protected $values = [];

  public function __construct(){
    //$this->create_db(SERVER);
    $this->db = SERVER;
  }

  public function destroy(){
    $this->drop_db(GAME);
    $this->drop_db(SERVER);
    $this->db = "";
  }

  public function makeNew(){
    $this->db = "";
    $this->drop_db(SERVER);
    $this->create_db(SERVER);
    $this->db = SERVER;
    $this->makeTableAccounts();
    $a = new Server();
    $a->makeAccountImagesTable();
    header('Location: login.php?msg=Server has been reset<br>');
  }

  public function makeTableAccounts(){
    $this->table = "accounts";
    $this->str = "(`id` int(11) NOT NULL AUTO_INCREMENT, `login_name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL, `password` varchar(32) NOT NULL, `date_created` timestamp(6) NOT NULL DEFAULT CURRENT_TIMESTAMP(6), `times_logged_in` int(10), `last_login` timestamp(6), `ip_address` varchar(64), `banned` int(1), `status` varchar(32), `session_id` varchar(32), `games_joined` int(6), `msg_signature` varchar(255), `tokens` int(11), `player_image_path` varchar(255), `total_forum_posts` int(11), `forum_likes` int(11), `forum_dislikes` int(11), PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    $this->drop_table($this->table);
    $this->create_table($this->table, $this->str);
    $this->makeUser('Owner', 'password', 1);
    $this->makeUser('Admin', 'password', 2);
    $this->makeUser('Test', 'password');
  }

  public function makeAccountImagesTable(){
    $this->table = "account_images";
    $this->str = "(`id` tinyint(3) NOT NULL AUTO_INCREMENT, `type` varchar(25) NOT NULL, `data` mediumblob NOT NULL, `account_id` int(8) NOT NULL, PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    $this->drop_table($this->table);
    $this->create_table($this->table, $this->str);
  }

  public function makeUser($login_name, $password, $status = 0){
    $this->table = "accounts";
    $this->fields = array("login_name", "password", "status");
    $this->values = array($login_name, md5(md5($password)), $status);
    $this->insert($this->table, $this->fields, $this->values);
  }

  public function registerUser($login_name, $password, $password2, $status = 0){
    $users = new Users();
    $isAvailable = false;
    $isMatch = ($password == $password2) ? true : false;
    $out = "";

    for($i=0; $i<count($users->data); $i++){
      if($users->data[$i]['login_name'] == $login_name){
        $isAvailable = false;
        break;
      }else{
        $isAvailable = true;
      }
    }

    if($isAvailable && $isMatch){
      $this->makeUser($login_name, $password);
      $out .= "Registered User: " . $login_name . "<br>";
      header('Location: login.php?msg='.$out.'&name='.$login_name);
    }else{
      $out .= (!$isAvailable) ? "User with that name already exists.<br>" : "";
      $out .= (!$isMatch) ? "Passwords do not match.<br>" : "";
      header('Location: register.php?msg='.$out);
    }

    echo $out;

  }

  public function loginUser($login_name, $password){
    $users = new Users();
    $id=null;
    $isMatch = false;
    $out = "";

    for($i=0; $i<count($users->data); $i++){
      if($users->data[$i]['login_name'] == $login_name && $users->data[$i]['password'] == md5($password)){
        $isMatch = true;
        $timestamp = date('Y-m-d H:i:s');
        $key = bin2hex(random_bytes(16));
        $logCount = !empty($users->data[$i]['times_logged_in']) ? $users->data[$i]['times_logged_in']+1 : 1;
        $this->update("accounts", array("times_logged_in", "last_login", "session_id"), array("id"), array($logCount, $timestamp, $key, $users->data[$i]['id']));
        $id = $users->data[$i]['id'];
        session_unset();
        $_SESSION['id'] = $users->data[$i]['id'];
        $_SESSION['name'] = $users->data[$i]['login_name'];
        $_SESSION['key'] = $key;
        break;
      }
    }

      $out = (!$isMatch) ? "Please try again." : "";

      $msg = ($isMatch) ? header('Location: gamelist.php') : header('Location: login.php?msg='.$out);

  }

}

class Users extends Server {
  public function __construct(){
    $this->db = SERVER;
    $this->table = "accounts";
    $this->select($this->table);
  }

}

class User extends Users {
  public function __construct(){
    session_start();
    $isLoggedin = FALSE;
    $user = FALSE;

    $read = new Users();
    $data = $read->data;

    foreach($data as $val){
      if($val['id'] == $_SESSION['id'] && $val['session_id'] == $_SESSION['key']){
        $isLoggedin = TRUE;
        $this->data = $val;
        break;
      }
    }
    $redirect = (!$isLoggedin) ? header('Location: login.php') : '';
  }
}

// ~/~/~/IMPORTANT!!! RESETS ROOT DATABASE RUN ONCE BEFORE ATTEMPTING TO USE ./register.php OR ./login.php.
// ~/~/~/IMPORTANT: COMMENT ALL 3 CALLS OUT AFTER RUNNING.

//$a = new Server();
// ~/~/~/ READE ME: Drops ALL game databses and Drops root DATABASE
//$a->destroy();
//Creates a brand new root database and creates the necessary tables
//$a->makeNew();
//$a->makeAccountImagesTable();

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
