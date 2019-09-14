<?php
require __DIR__  . '/../../general.php';
if(isset($_POST['get_user_view'])){
	$result = user_chat_view($user_data, 'deleted_message', $database_connection);
	echo json_encode($result);
}
function user_chat_view($user_data, $deleted_message, $database_connection){
	if(check_user_permission($user_data, $deleted_message, $database_connection) === true){
		$result = "
			<div class='user_box'>
				<div class='user_name'>data.name</div>
				<div class='add_message_time'>data.add_time</div>
					<ul class='hide_menu'>
						<li class='deleted_message' onclick='return confirmdelete(&quot;data.id&quot;)'><a href='#'>Удалить</a></li>
						<li class='edit_message'onclick='return edit_message(&apos;data.id&apos;, &apos;data.message&apos;)'><a href='#'>Редактировать</a></li>
					</ul>
			</div>
			<div class='user_message'>data.message</div>
		";
	}else{
		$result = "
			<div class='user_box'>
				<div class='user_name'>data.name</div>
				<div class='add_message_time'>data.add_time</div>
			</div>
			<div class='user_message'>data.message</div>
			
		";
	}
	return ($result);
}