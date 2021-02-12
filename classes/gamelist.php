<?php
  include_once 'server.class.php';
  $read = new User();
  $val = $read->data;
  $isOwner = ($val['status'] == 1) ? TRUE : FALSE;
  $isAdmin = ($val['status'] == 2) ? TRUE : FALSE;

  //print_r($val);
  $prnt = '';
  $img = new Server();
  $img->select("account_images", "*", array('account_id'), array($val['id']));
  //echo var_dump($img->data[0]['data']);
  $encoded_img = (!empty($img->data[0])) ? base64_encode($img->data[0]['data']) : "";
  $img_tag = (!empty($img->data[0])) ? '<img src="data:image/png;charset=utf8;base64,'.$encoded_img.'" style=width:50px;height: 50px;">' : "";
  $games_joined = (!empty($val['games_joined'])) ? $val['games_joined'] : 0;
  $forum_posts = (!empty($val['total_forum_posts'])) ? $val['total_forum_posts'] : 0;
  $forum_likes = (!empty($val['forum_likes'])) ? $val['forum_likes'] : 0;
  $forum_dislikes = (!empty($val['forum_dislikes'])) ? $val['forum_dislikes'] : 0;
  $msg_signature = (!empty($val['msg_signature'])) ? $val['msg_signature'] : "Signature not set.";

  $admin_options = '';
  if($isOwner == 1 || $isAdmin == 2){
  $admin_options = "<tr><form action='new_game.php' method='post'><td>Create New Game:<br>Name: <input type='text' name='game_name'><br><input type='submit'></td></form>";

  //NOTICE: Compiles fine on my local environment. Does not deploy
  $admin_options .= (!$isOwner) ? "" : "<form action='server.php' method='post'><td><input type='submit' name='reset' value='RESET SERVER' onClick='confirm(\"Are you sure? This cannot be undone.\");'></td></form>";

  $admin_options .= "</tr>";
  }

include 'navbar.php';
$prnt = <<< EOF
<style>
td {
    border:black solid 1px;
    margin:auto;
    padding:auto;
    text-align:center;
}
</style>
<div >
<table >
<tr>
<td>ID: <br>{$val['id']}</td>
<td>ACCOUNT: <br>{$val['login_name']}</td>
</tr>
<tr>
<td>DATE JOINED: <br>{$val['date_created']}</td>
<td>LAST LOGIN: <br>{$val['last_login']}</td>
</tr>
<tr>
<td>TIMES LOGGED IN: <br>{$val['times_logged_in']}</td>
<td>GAMES JOINED: <br>{$games_joined}</td>
</tr>
<tr>
<td>FORUM POSTS: <br>{$forum_posts}</td>
<td>LIKES / DISLIKES: <br>{$forum_likes} / {$forum_dislikes}</td>
</tr>
<form action='update_account.php' method='post' enctype='multipart/form-data'>
<tr>
<td colspan='2'>
Message Signature: <br>
{$msg_signature}
<hr>
<textarea name="sig" rows="4" cols="50" maxlength='255'>
</textarea>
</td>
</tr>
<tr>
<td>
ACCOUNT IMAGE: <br>
{$img_tag}
</td>
<td>
UPLOAD NEW IMAGE: <br>
<input type='file' name='plyr_img' id='plyr_img'>
</td>
</tr>
<tr><td colspan='2'><input type='submit' value='Update Account' name='submit'></td></tr>
</form>
{$admin_options}
</table>
</div>
EOF;
echo $prnt;
?>
