<?php
require __DIR__  . '/../../general.php';
if(isset($_POST['getRoomMessages']) && isset($_POST['message_id'])){
	$message_id = '';
	$room_id = $_POST['getRoomMessages'];
	if(!empty($_POST['message_id'])){
		$message_id = $_POST['message_id'];

	}
	if(permission_room($room_id, $user_rooms) == true){
		$result = getRoomMessages($database_connection, $user_data, $room_id, $message_id);
		if($result != null){
		echo json_encode($result);
		}
	}
	else{
		echo json_encode('Ошибка 403! У вас не достаточно прав для просмотра , либо страница не существует.');
	}
}

//send message 

if(isset($_POST['send_message'])&& isset($_POST['id'])){
	if(!empty($_POST['send_message'])){
		$room_id_cookie = trim($_COOKIE['room']);
		$room_id = trim(str_replace('room_', '', $_POST['id']));
		if($room_id_cookie == $room_id){
			if(permission_room($room_id, $user_rooms) == true){
				$user_id = $user_data['id'];
				add_message($user_id, $_POST['send_message'],$room_id, $database_connection);
			}
		}
	}
}

function getRoomMessages($db, $login, $room, $message_id = ''){
	$select_message = mysqli_query($db, 
		"SELECT user.name, messages.id, message, add_time FROM messages
		INNER JOIN user ON messages.user_id = user.id AND messages.room_id = '$room'
		WHERE messages.id > '$message_id'
		ORDER BY messages.id DESC LIMIT 50");
	$message_data = array();
		
	while($message = mysqli_fetch_assoc($select_message)){ 
		$message_data[] = $message;
	}
	$message_data = array_reverse($message_data);
	return $message_data;
}

function permission_room($room_id, $user_rooms){
	if(!empty($room_id)){
		foreach($user_rooms as $rooms){
			if($rooms['room_id'] == $room_id){
				setcookie('room', $room_id, time() +300, '/');
				return true;
			}
		}
		return false;
	}
}

function add_message($user_id, $message, $room_id, $db) {
	$message = mysqli_real_escape_string($db, $message);
	$write_message = "INSERT INTO messages (user_id, message, room_id) VALUES ('$user_id', '$message', '$room_id')";
	if(!mysqli_query($db, $write_message)){
		echo json_encode('Ошибка 403! У вас не достаточно прав для просмотра , либо страница не существует.');
	}
}
