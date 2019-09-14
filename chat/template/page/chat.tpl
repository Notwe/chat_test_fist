<div class='head_menu'>
	<form method=POST>
		<input class='button_exit' type=submit name=exit value='Выход'>
	</form>
</div>
<div class='main_left_menu'>
	<div class="hello_user" onclick='qwer()'>Привет&nbsp;&nbsp;&nbsp;<a href='#'><b><?=$_COOKIE['login'] ?? 'Гость';?></a></b></div>
	<div class='public_room_list'>
	</div>
	<div class='private_room_list'>
	</div>
	<div class='friend_list'>
	</div>
</div>

<div class='main_box' id='main_box'>
	<li id='error_message'></li>	
	<div class='message_box' id='message_box'></div>
	<div class='send_message'>
		<textarea class='user_send_message' name='send_message'></textarea>
		<input class='button_send_message' type=button>
	</div>	
</div>