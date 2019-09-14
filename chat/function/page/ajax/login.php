<?php
require_once __DIR__ . '/../../general.php';

function authorise(string $login, string $password, $user_data, $db){
	$error_message = [];
	if(empty($login)){
		$error_message[] = 'Логин не может быть пустым!';
	}
	if(empty($password)){
		$error_message[] = 'Пароль не может быть пустым!';
	}
	if(empty($error_message)){
		$login = trim($login);
		$password = hash('sha256', trim($password));
        if (is_authorised($login, $password, $db) === true){
			return [];
		}
    } 
	else {
		return $error_message;
	}
	
	$error_message[] = 'Логин или пароль не совпадают! Попробуйте еще раз...';
	return $error_message;
}

$error_message = [];

if(isset($_POST['login'], $_POST['password'])){
	$error_message = authorise(trim($_POST['login']), trim($_POST['password']), $user_data, $database_connection);
	if(empty($error_message)) {
		$data = get_user_data($_POST['login'], $database_connection);
		$user_name = $data['name'];
		$user_pass = $data['password'];
		setcookie('login', $user_name, time() +100000, '/');
		setcookie('pass', $user_pass, time() +100000, '/');
		exit;
	}
	else{
		echo json_encode($error_message);
	}
   }