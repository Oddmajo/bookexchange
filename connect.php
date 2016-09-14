<?php
$dbHostname="localhost";
$dbUsername="root";
$dbPassword="";//Lrz9RPVb7zPH2aTA";
$dbName="bookexchange";

/* $connection = mysql_connect('localhost', 'root', '');
if (!$connection){
    die("Database Connection Failed" . mysql_error());
}
$select_db = mysql_select_db('bookexchange');
if (!$select_db){
    die("Database Selection Failed" . mysql_error()); */
	
// Create connection
$conn = new mysqli($dbHostname, $dbUsername, $dbPassword, $dbName);
// Check connection
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
?>