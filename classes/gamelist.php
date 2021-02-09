<?php
  include_once 'server.class.php';
  session_start();

  $debug = 1;
  if ($debug) {
  $read = new server();
  $read->select('accounts');
  $data = $read->data;
  //print_r($data);
  foreach ($data as $val) {
      //echo print_r($val) . '<br>';
      if ($val['id'] == $_SESSION['id']) {
          //print_r($val);
          $prnt = '';
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
<td>GAMES JOINED: <br>{$val['games_joined']}</td>
</tr>
<tr>
<td>FORUM POSTS: <br>{$val['total_forum_posts']}</td>
<td>LIKES / DISLIKES: <br>{$val['forum_likes']} / {$val['forum_dislikes']}</td>
</tr>
<form action='update_account.php' method='post'>
<tr>
<td colspan='2'>
Message Signature: <br>
{$val['msg_signature']}
<hr>
<textarea name="sig" rows="4" cols="50" maxlength='255'>
</textarea>
</td>
</tr>
<tr>
<td>
ACCOUNT IMAGE: <br>
<img src="{$val['player_image_path']}">
</td>
<td>
UPLOAD NEW IMAGE: <br>
<input type='file' name='plyr_img'>
</td>
</tr>
<tr><td colspan='2'><input type='submit' value='Update Account'><td></tr>
</form>
</table>
</div>
EOF;
echo $prnt;
      }
  }
  }

  $out = "";
  if(isset($_SESSION['id']) && isset($_SESSION['name'])){
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];

    $out .= "Logged in as: " . $name." - [".$id."]<br><a href='register.php'>Register</a><br><a href='login.php'>Login</a><br>";
  }else{
    header('Location: login.php');
  }

  echo $out;
?>
