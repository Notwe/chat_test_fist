<?php
require __DIR__  . '/../../general.php';
if(isset($_POST['roomlist'])){
	echo json_encode($user_rooms);

}

