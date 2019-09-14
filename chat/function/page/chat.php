<?php

if(isset($_POST['exit'])){
	header('Location: index.php');
	setcookie('login', "", time() -100500, '/');
	setcookie('pass', "", time() -100500, '/');
	setcookie('room', "", time() -100500, '/');
}

if (is_authorised(trim($_COOKIE['login'] ?? ''), trim($_COOKIE['pass']?? ''), $database_connection) === false){
	header('location: index.php');
	exit;
}
if(!empty($_POST['send_message'])){
	$user_id = $user_data['id'];
	add_message($user_id, $_POST['send_message'], $database_connection);
}

function add_message($login_id, $message, $db) {
	$write_message = "INSERT INTO messages (user_id, message) VALUES ('$login_id', '$message')";
	mysqli_query($db,$write_message);
}
