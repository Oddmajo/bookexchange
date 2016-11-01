<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">

    <title>BookExchange</title>

    <?php
        require_once("bootstrap-head.php");
		require_once("encrypt.php");
    ?>

    <!-- Custom styles -->
    <!--<link href="commonstyles.css" rel="stylesheet" type="text/css">-->
	<link href="account.css" rel="stylesheet" type="text/css">
   
</head>
<body>	
	<?php 
		require_once("connect.php");
		
		$xml=simplexml_load_file("http://isbndb.com/api/v2/xml/C1ISCJUG/book/Data_Mining_practical_machine_learning_tools_and_techniques_") or die("Error: Cannot load file");
		//echo $xml->asXML();
		
		?>
		<br><br><br>
		<?php
		// foreach ($xml->children() as $child)
		// {
			// echo "Child node: " . $child->getName() . "<br>";
		// }
		echo $xml->data[0]->title . "<br>";
		$i = 0;
		while($xml->data[0]->author_data[$i])
		{
			echo $xml->data[0]->author_data[$i]->name . "<br>";
			$i = $i + 1;
		}
		echo $xml->data[0]->isbn10 . "<br>";
		echo $xml->data[0]->isbn13 . "<br>";
		echo "End.";
		
		$year = date("Y");
		for($i = 0; $i < 4; $i++)
		{
			echo $year + $i;
		}
	?>




</body>