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
		<p>Hey man this here is some of the gnarliest stuff ever.  You can create a list of books you have, and people will pay you to share them! Or you can find books that you still need, and share them with the owner for a fraction of the price of buying them!!  That shit tight.</p>
	</div>
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<a class="btn btn-primary btn-lg" href="login.php" style="width:100%">Login</a>
			</div>
			<div class="panel-body">
				If you are returning, please login here.  You can continue to do amazeballs stuff with other people doing amazeballs stuff.
			</div>
		</div>
	</div>
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">
				<a class="btn btn-primary btn-lg" href="create-account.php" style="width:100%">Create Account</a>
			</div>
			<div class="panel-body">
				If this is your first time coming to this amazeballs site, create an account so you can do some amazeballs stuff - borrowing and lending books for profit.
			</div>
		</div>
	</div>
</div>
</body>