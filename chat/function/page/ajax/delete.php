<?php
require __DIR__  . '/../../general.php';
if(check_user_permission($user_data, 'deleted_message', $database_connection) === true){
	if(!empty($_POST['id'])){
		$message_id = trim($_POST['id']);
		$deleted_user_messages = mysqli_query($database_connection, "DELETE FROM `mysqltest`.`messages` WHERE  `id`='$message_id'");
		if(!$deleted_user_messages){
			echo json_encode('Ошибка! В данный момент сообщение не может быть удалено, попробуйте позже...');
		}
	}
}
else{
	echo json_encode('Ошибка! У вас недостаточно прав');
}

?>