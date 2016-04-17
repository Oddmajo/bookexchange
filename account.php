<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">

    <title>Account: [Insert Name]</title>

    <?php
        require_once("bootstrap-head.php");
    ?>

    <!-- Custom styles -->
    <!--<link href="commonstyles.css" rel="stylesheet" type="text/css">-->
   
</head>
<body>
<?php
	include_once("navbar.php");
?>
<div class="container" style="margin-top:100px;">
	<div class="panel panel-default">
		<div class="panel-body">
			<div class="col-lg-6">
				Name:<br>
				Phone Number:<br>
				Email:<br>
				<hr>
				<div class="panel panel-default">
					<div class="panel-heading">
						Shipping Address
					</div>
					<div class="panel-body">
					</div>
				</div>
			</div>
			<div class="col-lg-6">
				School:<br>
				Major:<br>
				[Placeholder]:<br>
				<hr>
				<div class="panel panel-default">
					<div class="panel-heading">
						Shipping Address
					</div>
					<div class="panel-body">
					</div>
				</div>
			</div>
		</div>
	</div>
	<hr>
	<div class="col-lg-6">
		<div class="panel panel-default">
			<div class="panel-heading">Need</div>
			<div class="panel-body">
				
				<button style="margin: 0px" type="button" class="btn btn-primary">+</button>
				
				<div class="panel panel-default">
					<div class="panel-body">
						<div class ="col-lg-3">
								<img src="images\eea.png">
							</div>
							<div class ="col-lg-8">
								Title </br>
								Author </br>
								ISBN </br>
							</div>
							<div class="col-lg-1">
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
							<div class ="col-lg-8">
								Title </br>
								Author </br>
								ISBN </br>
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
			
			<button type="button" class="btn btn-primary">+</button>
				<div class="panel panel-default">
					<div class="panel-body">
						<div class ="col-lg-3">
								<img src="images\eea.png">
							</div>
							<div class ="col-lg-8">
								Title </br>
								Author </br>
								ISBN </br>
							</div>
							<div class="col-lg-1">
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
							<div class ="col-lg-8">
								Title </br>
								Author </br>
								ISBN </br>
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