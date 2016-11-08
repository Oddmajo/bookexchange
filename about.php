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
				
    ?>
	<title>About</title>
	
    <!-- Custom styles -->
    <!--<link href="commonstyles.css" rel="stylesheet" type="text/css">-->
	<link href="account.css" rel="stylesheet" type="text/css">
   
</head>
<body>
<?php
	
	include_once("navbar.php");
	
	
	
?>
<div class="container" style="margin-top:100px;">
	<div class="panel panel-default">
		<div class="panel-heading">
			Here is where to put a large section header
		</div>
		<div class="panel-body">
			Here is where to put stuff about that section
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			Here is where to put a large section header
		</div>
		<div class="panel-body">
			Here is where to put stuff about that section
		</div>
	</div>
</div>





	<?php
        require_once("bootstrap-body.php");
    ?>
</body>