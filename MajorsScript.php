<?php
require_once("connect.php");

$file = file("MajorsList.txt");
$count = count($file);


if($count > 0) #file not empty
{
	#This is the databases name and how to insert in to MYSQL
	$i = 1;
	$major_query="INSERT into major () values ";

	foreach ($file as $row)
	{
		

	}

	mysql_query($major_query) or die(mysql_error());

	
}

$conn->close();
?>