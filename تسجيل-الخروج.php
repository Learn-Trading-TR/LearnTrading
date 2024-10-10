<?php
session_start(); 


$_SESSION = [];


session_destroy();

header("Location: الرئيسية.php"); 
exit;
?>
