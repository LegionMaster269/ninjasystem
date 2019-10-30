<?php 
$dbhost = 'localhost';
$dbname = 'attendance';
$dbuser = 'root';
$dbpass = '';
$connection = new mysqli($dbhost,$dbuser,$dbpass,$dbname);





function queryMysql($query) {
global $connection;
$result = $connection->query($query);
if (!$result) die($connection->error);
return $result;
}


function sanitizeString($var) {
global $connection;
$var = strip_tags($var);
$var = htmlentities($var);
$var = stripcslashes($var);
return $connection->real_escape_string($var);
}

 ?>
