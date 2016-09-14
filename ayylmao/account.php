<?php
// if the user wants to log out, send them to the home page
if (isset($_GET['logout'])) {
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    session_destroy();
    header("Location: home.php");
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
    <meta name="author" content="Joe Sorgea">

    <title>My Account</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/dropdown.css" rel="stylesheet">

    <!-- Custom styles -->
    <link href="commonstyles.css" rel="stylesheet" type="text/css">
    <link href="login.css" rel="stylesheet" type="text/css">

    <script src="bootstrap/assets/js/ie-emulation-modes-warning.js"></script>
</head>

<body>
    <?php
        $allowCoaches = true;
        $allowPlayers = true;
        require('protected.php');
        include_once('navbar.php');
    ?>

    <div class="content">
        <div class="content-column-center">
            <!-- sign out form. sets logout to 1 when the user presses sign out -->
            <form class="form-signin" action="?logout=1" method="post">
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign out</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
