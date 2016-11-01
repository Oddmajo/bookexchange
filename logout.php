<?php

if(!isset($_SESSION)) 
{
	session_start();
}

require_once("encrypt.php");
require_once("connect.php");

if(isset($_SESSION['userId']))
{
	session_destroy();
	

	header("Location: main.php");
}

?>