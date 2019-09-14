<?php
$server = "localhost";
$database = "mysqltest";
$user_local = "root";
$password = '';

$database_connection = mysqli_connect($server, $user_local, $password, $database);
if (!$database_connection) {
      die("что-то пошло не так: " . mysqli_connect_error());
}