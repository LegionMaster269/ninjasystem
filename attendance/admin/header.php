<?php 
session_start();
require_once 'functions.php';

if (isset($_SESSION['user'])) {
	$user = $_SESSION['user'];
	$loggedin = true;
}
else $loggedin = false;


	
	if ($loggedin) {

	}

	else

	echo ""; 
 ?>
