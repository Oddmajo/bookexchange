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
			
        ?>
        <form action="?submit=1" method="post">
			<div class="form-group">
                <label for="ISBN">ISBN:</label>
                <input type="text" class="form-control" name="fname" id="fname" placeholder="ISBN Number" maxlength="25" >
            </div>
			
            <button type="submit" class="btn btn-primary">Add Book</button>
		</form>
    </div>

    <?php
        require_once("bootstrap-body.php");
    ?>
</body>
</html>