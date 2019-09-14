<?php
include __DIR__ . '/page/config/connection.php';  
function getTemplate(string $general_template, string $page, array $page_list, array $page_params) : string
{
	  extract($page_params);
	  $title = $page_list[$page]['title'];
	  
	  ob_start();
	  include_once __DIR__ . '/../template/page/' . $page . '.tpl';
	  $page_data = ob_get_clean();
	   
	  ob_start();
	  include_once __DIR__ . '/../template/' . $general_template . '.tpl';
	  $page_data = ob_get_clean();
	  return $page_data;
}



function getFunctionality (string $page)
{
	   $functionality_path = __DIR__ . '/page/' . $page . '.php';
	   if(file_exists($functionality_path)){
	       return $functionality_path;
     }
     return null;
}

function getPage (string $page, array $page_list)
{
	   if(!array_key_exists($page, $page_list)){
			$page = '404';
	   }
	   return $page;
}

function is_authorised(string $login, string $pass, $db)
   {
	  if(!empty($login) && !empty($pass)){
		  if(db_authorised_user($login, $pass, $db) === true){
			  return true;
		  }
        }
		 else{
			 return false;
		 }
   } 
function db_authorised_user(string $name_user, string $pass_user, $db)
{
	$check_user = mysqli_query($db, "SELECT * FROM user WHERE name = '$name_user' AND password = '$pass_user'");
	if(mysqli_num_rows($check_user) > 0){
		return true;
	}
	else{
		setcookie('login', $name_user, time() -100500, '/');
		setcookie('pass', $pass_user, time() -100500, '/');
		return false;
		exit;
	}
}
function get_user_data($login, $db)
{
	$user_data = mysqli_query($db, "SELECT id, name, password FROM user WHERE name = '$login'");
	$result = mysqli_fetch_array($user_data);
	return $result;
}

function get_user_room($db, $user_data){
	$user_id = $user_data['id'];
	$user_room = mysqli_query($db, 
	"SELECT room.name_room, permission_room.room_id FROM permission_room  
	INNER JOIN room ON permission_room.room_id = room.id
	WHERE permission_room.user_id = '$user_id'"
	);
	$data_room = array();
	while($data = mysqli_fetch_assoc($user_room)){
		$data_room[] = $data;
	}
	return $data_room;
	}

function check_user_permission($user_data, string $priv = '', $db)
{
	$user_name = $user_data['name'];
	$user_permission = mysqli_query($db, 
		"SELECT * FROM privilege_roles 
		INNER JOIN user ON privilege_roles.roles_id = user.rol_id AND user.name = '$user_name'
		INNER JOIN privilege ON privilege_roles.privilege_id = privilege.id AND privilege.name = '$priv'");
	if(mysqli_num_rows($user_permission) > 0){
		return true;
	}
	else{
		return false;
	}
}
if (is_authorised(trim($_COOKIE['login'] ?? ''), trim($_COOKIE['pass']?? ''), $database_connection) === true){
	$user_data = get_user_data($_COOKIE['login'], $database_connection);
	$user_rooms = get_user_room($database_connection, $user_data); 
	
}

if(!empty($_COOKIE['room'])){
	$current_room = $_COOKIE['room'];
}
  
$page_params = [
	'current_room' => $current_room,
	'user_data' => $user_data,
	'user_rooms' => $user_rooms,
	'database_connection' => $database_connection,
];
$pages = [
  'index' => 
       ['title' => 'Чат'],
  '404'  =>
       ['title' => 'Ошибка'],
  'sign-up' => 
       ['title' => 'Регистрация'],
  'chat' => 
       ['title' => 'Клубный чат'],
  'room' =>
	   ['title' => 'Комнаты Чата'],
  'sign-in'=>
		['title'=> 'Вход']
];
  
