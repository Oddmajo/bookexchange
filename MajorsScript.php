<?php
require_once("connect.php");

$file = file("MajorsList.txt");
$count = count($file);


if($count > 0)
{
	
	$i = 1;
	$major_query="INSERT into major (major) values ";

	foreach ($file as $row)
	{
		$majors = explode("\t", $row);
		$c = count($majors);
		for($x = 0; $x < $c; $x++)
		{
			$query = $major_query . "('{$majors[$x]}')";
			echo $query;
			echo "<br>";
			$result = $conn->query($query);
		}

	}

	//mysql_query($major_query) or die(mysql_error());

	
}

$conn->close();
?>