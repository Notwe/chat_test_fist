<?php
if (is_authorised(trim($_COOKIE['login'] ?? ''), trim($_COOKIE['pass']?? ''), $database_connection) === true) {
	header('location: ?page=chat');
}