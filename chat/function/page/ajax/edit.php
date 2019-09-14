<?php
require __DIR__  . '/../../general.php';
if(check_user_permission($user_data, 'edit_message', $database_connection) === true){
	if(isset($_POST['id']) && isset($_POST['messages'])){
		if(!empty($_POST['id']) && !empty($_POST['messages'])){
			$message_id = trim($_POST['id']);
			$message_text = trim($_POST['messages']);
			$update_user_message = mysqli_query($database_connection, "UPDATE messages SET message = '$message_text' WHERE id = '$message_id'");
			if(!$update_user_message){
				echo json_encode('Ошибка! В данный момент сообщение не может быть изменено, попробуйте позже...');
			}
		}
	}
}
else{
	echo json_encode('Ошибка! У вас недостаточно прав');
}
?>