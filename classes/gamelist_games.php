<?php
include_once 'server.class.php';
session_start();

$debug = 1;
if ($debug)
{
    $read = new server();
    $read->select('games');//need to also get accounts
    $data = $read->data;
    //print_r($data);
    foreach ($data as $val)
    {
        //echo print_r($val) . '<br>';
        if ((($val['status'] == 'Admin') || ($val['status'] == 'Owner')) && ($val['session_id'] == $_SESSION['id']))
        {
$admin_options = '';
$admin_options = <<< AOF 
<h3>Create New Game</h3>
<form action='new_game.php' method='post'>
<p>Game Name: <input type='text' name='game_name'></p>
<p>Admin: <input type='text' name='admin_name'</p>
<br>
<input type='submit'>
</form>
$AOF;
            //print_r($val);
include 'navbar.php';
$prnt = '';
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
{$admin_options}
<table >
<tr>
<td>GAME NAME: <br>{$val['name']}</td>
<td>ADMIN: <br>{$val['admin']}</td>
</tr>
<tr>
<td>DATE STARTED: <br>{$val['date_started']}</td>
<td>STATUS: <br>{$val['status']}</td>
</tr>
<tr>
<td colspan='2'>DESCRIPTION: <br>{$val['dscrpt']}</td>
</tr>
<tr>
<td colspan='2'>
<form action='<?php $game_var_url ;?>' method='get'>
<input type='submit' value='JOIN GAME'>
</form>
</td>
</tr>
</table>
</div>
EOF;
echo $prnt;
        }
        elseif (/* is not admin*/) {
            // code...
        }
    }//foreach
    

    
}

$out = "";
if (isset($_SESSION['id']) && isset($_SESSION['name']))
{
    $id = $_SESSION['id'];
    $name = $_SESSION['name'];

    $out .= "Logged in as: " . $name . " - [" . $id . "]<br><a href='register.php'>Register</a><br><a href='login.php'>Login</a><br>";
}
else
{
    //header('Location: login.php');
    
}

echo $out;
?>
