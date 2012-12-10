<?php
$host_name = 'localhost';
$user_name = 'julia_webdev';
$pass_word = '1v9a9n8webdev';
$database_name = 'julia_webdev';

$conn = mysql_connect($host_name, $user_name, $pass_word) or die ('Error connecting to mysql');
mysql_select_db($database_name);
?>