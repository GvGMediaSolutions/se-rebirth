<?php
include_once 'server.class.php';
session_start();

$debug = 1;
if ($debug)
{
    $read = new server();
    $read->select('accounts');//need to also get accounts
    $data = $read->data;
    //print_r($data);
    foreach ($data as $val)
    {
        //echo print_r($val) . '<br>';
        if ((($val['status'] == 1) || ($val['status'] == 2)) && ($val['id'] == $_SESSION['id'] && $val['session_id'] == $_SESSION['key']))
        {

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
break;
        }
      //elseif (/* is not admin*/) {
            // code...
        //}
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
