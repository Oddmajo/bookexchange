<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">

    <title>BookExchange</title>

    <?php
		if(!isset($_SESSION)) 
		{
			session_start();
		}

        require_once("bootstrap-head.php");
		require_once("connect.php");
    ?>

    <!-- Custom styles -->
    <!--<link href="commonstyles.css" rel="stylesheet" type="text/css">-->
	<link href="account.css" rel="stylesheet" type="text/css">
   
</head>
<body>
<?php
	include_once("navbar.php");
?>
<div class="container" style="margin-top:100px;">
	<div class="jumbotron">
		<h1>BookExchange</h1>
		<p>Mission Statement Here</p>
	</div>
	<div class="col-lg-6">
		<?php
			if(!isset($_SESSION['userId'])) {
		?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<a class="btn btn-primary btn-lg" href="login.php" style="width:100%">Login</a>
			</div>
			<div class="panel-body">
				If you are returning to CollegeShare, please follow this button to login to your account.
			</div>
		</div>
		
		<?php
			} else {
		?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<a class="btn btn-primary btn-lg" href="account.php" style="width:100%">Account</a>
			</div>
			<div class="panel-body">
				Return to your Account page.
			</div>
		</div>
		<?php
			}
		?>
	</div>
	<div class="col-lg-6">
		<?php
			if(!isset($_SESSION['userId'])) {
		?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<a class="btn btn-primary btn-lg" href="create-account.php" style="width:100%">Create Account</a>
			</div>
			<div class="panel-body">
				If this is your first time visiting CollegeShare, please follow this button to create an account.  With your account, you will be able to buy, sell, rent, and share books with your fellow students.
			</div>
		</div>
		<?php
			} else {
		?>
		<div class="panel panel-default">
			<div class="panel-heading">
				<a class="btn btn-primary btn-lg" href="list.php" style="width:100%">In-Demand</a>
			</div>
			<div class="panel-body">
				Coming Soon! <br> This button will bring you to a list of all the books that are in demand.
			</div>
		</div>
		<?php
			}
		?>
	</div>
</div>

	<?php
        require_once("bootstrap-body.php");
    ?>
</body>