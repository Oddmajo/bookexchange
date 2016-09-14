<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">

    

    <?php
		if(!isset($_SESSION)) 
		{
			session_start();
		}
        require_once("bootstrap-head.php");
		require_once("connect.php");
		
		if(!($_SESSION['userId']))
			header("Location: login.php");
		$query = "SELECT fname, lname, phone, email, grad_year, school.name, bio
				FROM user, school
				WHERE school.school_id = user.school_id AND user_id = " . $_SESSION['userId'];
		$result = $conn->query($query);
		$info = $result->fetch_assoc();
		
    ?>
	<title>Account: <?php echo $info['fname'] . " " . $info['lname'] ?></title>
	
    <!-- Custom styles -->
    <!--<link href="commonstyles.css" rel="stylesheet" type="text/css">-->
	<link href="account.css" rel="stylesheet" type="text/css">
   
</head>
<body>
<?php
	if(!isset($_SESSION['email']))
	{
		header("Location: login.php");
	}
	include_once("navbar.php");
	
	
	
?>
<div class="container" style="margin-top:100px;">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="col-lg-6">
				<ul class="listing">
					<li>Name: <?php echo $info['fname'] . " " . $info['lname']?></li>
					<li>Phone Number: <?php echo $info['phone'] ?></li>
					<li>Email: <?php echo $info['email'] ?></li>
				</ul>
				<hr>
			</div>
			<div class="col-lg-6">
				<ul class="listing">
					<li>School: <?php echo $info['name'] ?></li>
					<li>Major: WIP</li>
					<li>Year: <?php echo $info['grad_year'] ?></li>
				</ul>
				<hr>
			</div>
			<p><?php echo $info['bio'] ?></p>
		</div>
	</div>
	<?php 
	if(isset($_GET["paired"]))
	{
	?>
	<div class="panel panel-default">
		<div class="panel-heading">Paired</div>
		<div class="panel-body">
			<div class="panel panel-default">
				<div class="panel-body">
					<div class="col-lg-2">
						<img src="images\eea.png">
					</div>
					<div class="col-lg-5">
						<ul class="listing">
							<li>Owner:</li>
							<li>Title:</li>
							<li>Edition</li>
							<li>Author:</li>
							<li>ISBN</li>
						</ul>
					</div>
					<div class="col-lg-5">
						<ul class="listing">
							<li>Borrowers:</li>
						</ul>
						Notes:
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php
	}
	?>
	<hr>
	<!--<div class="col-lg-4">
		<div class="panel panel-default">
			<div class="panel-heading">Paired</div>
			<div class="panel-body">
				
				<div class="panel panel-default">
					<div class="panel-body">
						<div class ="col-sm-4">
								<!--<img src="images\eea.png">
							</div>
							<div class ="col-sm-4">
								<ul class="listing">
									<li>Owner</li>
									
								</ul>
							</div>
							<div class="col-sm-4">
								<ul class="listing">
								</ul>
							<!--	<img style ="margin-top:25px" src="images\pencil.png">
								<img style ="margin-top:25px" src="images\xbutton.png">
							</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class ="col-lg-3">
								<!--<img src="images\eea.png">
							</div>
							<div class ="col-sm-8">
								Title </br>
								Author </br>
								ISBN </br>
							</div>
							<div class="col-lg-1">
								<!--<img style ="margin-top:25px" src="images\pencil.png">
								<img style ="margin-top:25px" src="images\xbutton.png">
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>-->
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">Need</div>
			<div class="panel-body">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class ="col-lg-5">
						</div>
						<div class ="col-lg-2">
							<button style="margin: px;" type="button" class="btn btn-primary">+</button>
						</div>
						<div class="col-lg-5">
						</div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-body">
						<div class ="col-sm-3">
							<img src="images\eea.png">
						</div>
						<div class ="col-sm-8">
							<li>Title:</li>
							<li>Edition</li>
							<li>Author:</li>
							<li>ISBN</li>
						</div>
						<div class="col-sm-1">
							<img style ="margin-top:25px" src="images\pencil.png">
							<img style ="margin-top:25px" src="images\xbutton.png">
						</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class ="col-lg-3">
								<img src="images\eea.png">
						</div>
						<div class ="col-sm-8">
							<li>Title:</li>
							<li>Edition</li>
							<li>Author:</li>
							<li>ISBN</li>
						</div>
						<div class="col-lg-1">
							<img style ="margin-top:25px" src="images\pencil.png">
							<img style ="margin-top:25px" src="images\xbutton.png">
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">Have</div>
			<div class="panel-body">
				<div class="panel panel-default">
					<div class="panel-body">
						<div class ="col-lg-5">
						</div>
						<div class ="col-lg-2">
							<button style="margin: px;" type="button" class="btn btn-primary">+</button>
						</div>
						<div class="col-lg-5">
						</div>
					</div>
				</div>
				
				<div class="panel panel-default">
					<div class="panel-body">
						<div class ="col-sm-3">
								<img src="images\eea.png">
							</div>
							<div class ="col-sm-8">
								<li>Title:</li>
								<li>Edition</li>
								<li>Author:</li>
								<li>ISBN</li>
							</div>
							<div class="col-sm-1">
								<img style ="margin-top:25px" src="images\pencil.png">
								<img style ="margin-top:25px" src="images\xbutton.png">
							</div>
					</div>
				</div>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class ="col-lg-3">
								<img src="images\eea.png">
							</div>
							<div class ="col-sm-8">
								<li>Title:</li>
								<li>Edition</li>
								<li>Author:</li>
								<li>ISBN</li>
							</div>
							<div class="col-lg-1">
								<img style ="margin-top:25px" src="images\pencil.png">
								<img style ="margin-top:25px" src="images\xbutton.png">
							</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>





	<?php
        require_once("bootstrap-body.php");
    ?>
</body>