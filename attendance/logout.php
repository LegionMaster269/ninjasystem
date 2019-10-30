<?php 
session_start();

if (!isset($_SESSION['user'])) {
    header('index.php');
}


if (session_destroy()) {
     echo "<script>window.location = 'index.php';</script>
     ";
}
 ?>