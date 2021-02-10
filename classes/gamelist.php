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
<tr><td colspan='2'><input type='submit' value='Update Account' name='submit'><td></tr>
</form>
</table>
</div>
EOF;
echo $prnt;
break;
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
