<?php
if(!isset($_SESSION)) 
{
	session_start();
}
require_once("connect.php");
require_once("encrypt.php");

if (isset($_GET["submit"])) 
{
    unset($_GET["submit"]);

    $ok = true;
    $success = false;
	
	$checks = "";

	$email = $_POST["email"];
    $query = "SELECT user_id FROM user WHERE email = '{$email}' LIMIT 1";
	$result = $conn->query($query);
	$validEmail = $result->fetch_assoc();
    if ($validEmail)
		$checks = $checks . "1";
	else
		$checks = $checks . "0";
	
	$password = $_POST["password"];
	if(checkPassword($password))
		$checks = $checks . "0";
	else
		$checks = $checks . "1";

    if ($_POST["password"] !== $_POST["confirmPassword"])
        $checks = $checks . "1";
	else
		$checks = $checks . "0";
	
	if($checks!="000")
	{
		//Should redirect and notify of mistakes
	}
    else // Insert user into user_login table 
	{
        $password = encryptPassword($_POST["password"]);
		
		$fname = $_POST["fname"];
		$lname = $_POST["lname"];
		$gradyear = $_POST["gradyear"];
		$email = $_POST["email"];
		$phone = $_POST["phone"];
        $query = "INSERT INTO user (fname, lname, grad_year, email, phone, password, school_id) VALUES ('{$fname}', '{$lname}', '{$gradyear}', '{$email}', '{$phone}', '{$password}', '1')";
		//$query->bind_param("ssssss", $_POST["fname"], $_POST["lname"], $_POST["gradyear"], $_POST["email"], $_POST["phone"], $password);
		//$result = $query->execute();
        $result = $conn->query($query);
		if (!$result) 
		{
			echo $query . "\n";
			throw new Exception("Database Error [{$conn->errno}] {$conn->error}");
		}
			//AddError("An unknown error occurred when inserting your account details into the database.");
		else
			$success = true;
        
    }

    if ($success)
        header("location: login.php");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">

    <title>BookExchange</title>

    <?php
        require_once("bootstrap-head.php");
    ?>

    <!-- Custom styles -->
    <!--<link href="commonstyles.css" rel="stylesheet" type="text/css">-->
	<link href="account.css" rel="stylesheet" type="text/css">
   
</head>

<body>
    <?php
        require_once("navbar.php");
    ?>
    <div class="container" style="margin-top:100px;">
		<?php
			//if($checks)
				//echo $checks;
        ?>
        <form action="?submit=1" method="post">
			<div class="form-group">
                <label for="fname">First Name:</label>
                <input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" maxlength="25" required>
            </div>
			<div class="form-group">
                <label for="lname">Last Name:</label>
                <input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" maxlength="25" required>
            </div>
			<div class="form-group">
                <label for="gradyear">Graduation Year:</label>
                <input type="text" class="form-control" name="gradyear" id="gradyear" placeholder="Graduation Year" maxlength="25" required>
            </div>
			<div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="Email Address" maxlength="70" required>
            </div>
            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="text" class="form-control" name="phone" id="phone" placeholder="Phone Number" maxlength="70" required>
            </div>
			<div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="Password" maxlength="25" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Password" maxlength="25" required>
            </div>
            <button type="submit" class="btn btn-primary">Create account</button>
		</form>
    </div>

    <?php
        require_once("bootstrap-body.php");
    ?>
</body>
</html>
