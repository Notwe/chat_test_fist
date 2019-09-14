<?php
$data_reg = $_POST;
function register(string $login, string $pass, string $pass2, $db)
{
	$error_messages = [];
	if(empty($login)){
		$error_messages[] = 'Логин не может быть пустым!';
	}
	if(empty($pass)){
		$error_messages[] = 'Пароль не может быть пустым!';
	}
	if(empty($pass2)){
		$error_messages[] = 'Подтвердите пароль!';
	}
	if($pass != $pass2){
		$error_messages[] = 'Пароль не совпадает.';
	}
	if(empty($error_messages)){
		$login = trim($login);
	    $pass = hash('sha256', trim($pass));
	    $pass2 = hash('sha256', trim($pass2));
		$check_user_name = mysqli_query($db, "SELECT * FROM user WHERE name = '$login'");
		$write_sql = "INSERT INTO user (name, password) VALUES ('$login', '$pass')";
		if(mysqli_num_rows($check_user_name) > 0){
			$error_messages[] = 'Такой пользователь уже существует';
			return $error_messages;
		}
		mysqli_query($db, $write_sql);
		mysqli_close($db);
		setcookie('login', $login, time() +100000, '/');
		setcookie('pass', $pass, time() +100000, '/');
	}
	return $error_messages;
}

$error_messages = [];

if(isset($data_reg['login_reg'], $data_reg['pass_reg'], $data_reg['pass2_reg'])){
	
	$error_messages = register($data_reg['login_reg'], $data_reg['pass_reg'], $data_reg['pass2_reg'], $database_connection);
	if(empty($error_messages)){
		header('location: ?page=chat');
	    exit;
	}
}

$page_params = [
'error_messages' => $error_messages,
];
	