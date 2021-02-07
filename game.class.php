<?php
include_once 'mvc.class.php';

class Game extends Db {
  public function __construct(){
    //$this->create_db(SERVER);
    //$this->db = GAME;
    //$this->create_table("daily_tips", " (`tip_id` int(4) NOT NULL auto_increment, `tip_content` text NOT NULL, PRIMARY KEY  (`tip_id`)) ENGINE=MyISAM");
    //$this->insert("daily_tips", "(`tip_id`, `tip_content`)", "(?, ?)", array(1, 'To customise your SE experiance, try playing with some of the options on the <b class=b1>Options</b> Page.'));
    //$this->update("daily_tips", "`tip_id`=?, `tip_content`=?", "(`tip_id`=?)", array(2, 'You can change your colour scheme at any time from the options page.<br>There are plenty to choose from.', 1));
    //$this->drop_db(SERVER);
    //$this->drop_table("daily_tips");
    //$this->delete("daily_tips", "(`tip_id`=?)", array(2));
    //$this->insert("daily_tips", "(`tip_id`, `tip_content`)", "(?, ?)", array(2, 'You can change your colour scheme at any time from the options page.<br>There are plenty to choose from.'));
    //$this->select("daily_tips", "*");
    //$this->select("user_accounts", "*", "login_id=? AND login_name=?", array(1, "Admin"));
    //$this->insert("user_accounts", "(`login_id`, `login_name`)", "(?, ?)", array(3, "Test"));
    //$this->select("user_accounts", "*", "login_id=? AND login_name=?", array(3, "Test"));
  }

    public function destroy(){
      $this->drop_db(GAME);
      $this->db = "";
    }

    public function makeNew(){
      $this->db = "";
      $this->create_db(GAME);
      $this->db = GAME;
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
$a->drop_table("accounts");
$a->create_table("accounts", "(`id` int(11) NOT NULL AUTO_INCREMENT, `login_name` varchar(32) COLLATE utf8mb4_unicode_ci NOT NULL, `password` varchar(32) NOT NULL, `date_created` varchar(64) NOT NULL, `times_logged_in` int(10), `last_login` varchar(64), `ip_address` varchar(64), `banned` int(1), `status` varchar(32), `session_id` varchar(32), PRIMARY KEY (`id`)) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;");

/*
DROP TABLE IF EXISTS
`accounts`;
CREATE TABLE `accounts` (
`id` int(11) NOT NULL
AUTO_INCREMENT,
`login_name` varchar(32)
COLLATE utf8mb4_unicode_ci
NOT NULL,
`password` varchar(32) OT
NULL,
`date_created` varchar(64)
OT
`times_logged_in` int(10)
`last_login` varchar(64)
`ip_address` varchar(64)
`banned` int(1)
`status` varchar(32)
`session_id` varchar(32)
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT
CHARSET=utf8mb4
COLLATE=utf8mb4_unicode_ci;
*/


/* ~/~/~ TEST AREA

$game = new Game();
$game->destroy();
$game->makeNew();