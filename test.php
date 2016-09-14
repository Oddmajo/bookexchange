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
		
		$fname = "test";
		$lname = "num2";
		$gradyear = "0";
		$email = "test4@example.com";
		$phone = "0123456789";
		$passwordplain = "1Password";
		$school = "1";
		
		$password = encryptPassword($passwordplain);
		
		$checks = "";
		
		$query = "SELECT user_id FROM user WHERE email = '{$email}' LIMIT 1";
		$result = $conn->query($query);
		$validEmail = $result->fetch_assoc();
		if ($validEmail)
			$checks = $checks . "1";
		else
			$checks = $checks . "0";
		
		if(checkPassword($passwordplain))
			$checks = $checks . "0";
		else
			$checks = $checks . "1";

		//if ($_POST["password"] !== $_POST["confirmPassword"])
		//	$checks = $checks . "1";
		//else
			$checks = $checks . "0";
		
		if($checks!="000")
		{
			echo $checks;
		}
		else
		{
			$query = "INSERT INTO user (fname, lname, grad_year, email, phone, password, school_id) VALUES ('test', 'num1', '0', '{$email}', '{$phone}', '{$password}', '{$school}')";
			$result = $conn->query($query);
			if (!$result) 
			{
				echo $query . "\n";
				throw new Exception("Database Error [{$conn->errno}] {$conn->error}");
			}
		}
		
		
	?>

</body>