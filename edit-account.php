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
	
	
	//$password = encryptPassword($_POST["password"]);
	
	//need to change this some
	$fname = $_POST["fname"];
	$lname = $_POST["lname"];
	$gradyear = $_POST["gradyear"];
	$email = $_POST["email"];
	$phone = $_POST["phone"];
	$bio = $_POST["bio"];
	//$query->bind_param("ssssss", $_POST["fname"], $_POST["lname"], $_POST["gradyear"], $_POST["email"], $_POST["phone"], $password);
	//$result = $query->execute();
	$query = "UPDATE user 
			SET fname = '{$fname}', lname = '{$lname}', grad_year = '{$gradyear}', email = '{$email}' phone = '{$phone}', bio = '{$bio}'
			WHERE user = " . $_SESSION['userId'];
	echo $query . "\n";
	//$result = $conn->query($query);
	if (!$result) 
	{
		echo $query . "\n";
		throw new Exception("Database Error [{$conn->errno}] {$conn->error}");
	}
		//AddError("An unknown error occurred when inserting your account details into the database.");
	else
		$success = true;

    if ($success)
        header("location: account.php");
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
		
		$query = "SELECT fname, lname, grad_year, email, phone, school.name, bio
				FROM user, school
				WHERE school.school_id = user.school_id AND user_id = " . $_SESSION['userId'];
		$result = $conn->query($query);
		$info = $result->fetch_assoc();
    ?>
    <div class="container" style="margin-top:100px;">
		<div class="panel panel-default">
			<div class="panel-body" style="margin:25px;">
			<form action="?submit=1" method="post">
				<div class="form-group">
						<label for="fname">First Name:</label>
						<input type="text" class="form-control" name="fname" id="fname" placeholder="First Name" maxlength="25" required>
					</div>
					<div class="form-group">
						<label for="lname">Last Name:</label>
						<input type="text" class="form-control" name="lname" id="lname" placeholder="Last Name" maxlength="25" required>
					</div>
					<div class="container">
						<div class="col-md-4">
							<div class="form-group>">
								<label for="school">School:</label>
								<br><p>Bradley University</p>
							</div>
						</div>
						
					</div>
					<div class="container">
						<div class="col-sm-6">
							<div class="form-group">
								<label for="gradyear">Graduation Year:</label>
									<select class="form-control" id="gradyear">
								<?php
									$year = date("Y");
									for($i = 0; $i < 7; $i++) { ?>
										<option><?php echo $year + $i; ?></option>
								<?php } ?>
									</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label for="major">Major:
								<button type="button" class="btn btn-secondary btn-xs" data-toggle="tooltip" data-placement="right" title="The ability to add multiple majors coming soon.  Please list whatever major is most descriptive of your education." style="background:none;padding:0;margin:0;">
									<span class="glyphicon glyphicon-question-sign"></span>
								</button>
								</label>
									<select class="form-control" id="major">
									<?php 
										$query = "SELECT * FROM major";
										$major = $conn->query($query);
										while($row = $major->fetch_assoc())
										{ ?>
											<option><?php echo $row['major']; ?> </option>
									<?php } ?>
									</select>
							</div>
						</div>
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
						<label for="password">Password:
							<button type="button" class="btn btn-secondary btn-xs" data-toggle="tooltip" data-placement="right" title="Your password must have at least one uppercase letter, at least one lowercase letter, and at least one number.  It should also be at least six characters long." style="background:none;padding:0;margin:0;">
								<span class="glyphicon glyphicon-question-sign"></span>
							</button>
						</label>
						<input type="password" class="form-control" name="password" id="password" placeholder="Password" maxlength="25" required>
					</div>
					<div class="form-group">
						<label for="confirmPassword">Confirm Password:
							<!--<button type="button" class="btn btn-secondary btn-xs" data-toggle="tooltip" data-placement="right" title="Password!" style="background:none;padding:0;margin:0;">
								<span class="glyphicon glyphicon-question-sign"></span>
							</button>-->
						</label>
						<input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="Password" maxlength="25" required>
					</div>
				<div class="form-group">
					<label for="bio">Biography:</label>
					<!--<br><p><?php //echo $info['bio'] ?></p>-->
					<input type="text" class="form-control" name="bio" id="bio" placeholder="<?php echo $info['bio'] ?>" maxlength="256" >
				</div>
				<button type="submit" class="btn btn-primary">Edit account</button>
			</form>
			</div>
		</div>
    </div>

    <?php
        require_once("bootstrap-body.php");
    ?>
</body>
</html>