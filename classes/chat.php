<?php
include_once 'server.class.php';
$chat_html = '';
// if post is submitted, assume it was from ajax
if (!empty($_POST))
{
  $server = new Server();
	// need chat table first
	// create table chat(id int auto_increment primary key, message varchar(255), created datetime not null default now());
  $message = $_POST['chat-message'];
	$message = htmlspecialchars($message);
	$message = str_replace("'", '&apos;', $message);

	//$sql = "INSERT INTO chat SET message = '{$message}'";
	//execute($sql);
  $server->insert('chat', array('message'), array($message));

	//$sql = "SELECT * FROM chat ORDER BY id DESC LIMIT 20";
	//$chats = selectAll($sql);
  $read = new Server();
  $read->select('chat');
  $chats = $read->data;
  //echo var_dump($chats);

  $chat_html = '';
  if(!empty($chats)){
  	foreach ($chats as $row)
  	{
  		$chat_html .= $row['created'].': '.$row['message'].'<hr />';
  	}
  }

	echo $chat_html;
	exit;
}else{
  $read = new Server();
  $read->select('chat');
  $chats = $read->data;
  //echo var_dump($chats);

  $chat_html = '';
  if(!empty($chats)){
  	foreach ($chats as $row)
  	{
  		$chat_html .= $row['created'].': '.$row['message'].'<hr />';
  	}
  }

	echo $chat_html;
	exit;
}

?>
