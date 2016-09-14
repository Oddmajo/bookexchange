<?php

session_start();
$hostname="localhost";
$username="dbadmin";
$password="testing";//Lrz9RPVb7zPH2aTA";
$dbname="elitelevelprospects";

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['login'])) {
    // get the username, password, and user type from the login form's results
    $username = $_POST['username'];
    $password = $_POST['password'];

    // query the database for the user. select from different tables based on user type
    $query = "SELECT * FROM user_login WHERE username='{$username}' and password='{$password}'";
    $result = $conn->query($query);
    if (!$result) {
        throw new Exception("Database Error [{$conn->errno}] {$conn->error}");
    }
    $row = $result->fetch_assoc();

    // if a result was found, redirect the user to their intended page
    if ($row) {
        $_SESSION['username'] = $username;
        $_SESSION['usertype'] = $row["role_type"];

        if (isset($_SESSION['dest'])) {
            $dest = $_SESSION['dest'];
            unset($_SESSION['dest']);
            header("Location: " . $dest);
        } else
            header("Location: home.php");
        exit;
    } else { ?>
        <!-- Tell the user their password was incorrect -->
        <p>Wrong username or password!</p>
 <?php }
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

    <title>Sign In</title>

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
        include_once('navbar.php');
    ?>
    <div class="content">
        <div class="content-column-center">
            <form class="form-signin" action="?login=1" method="post">
                <h2 class="form-signin-heading">Member sign in</h2>
                <!--<label for="inputUsername" class="sr-only">Username</label>-->
                <input type="username" id="inputUsername" name="username" class="form-control" placeholder="Username" required autofocus>
                <!--<label for="inputPassword" class="sr-only">Password</label>-->
                <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required>
                <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
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
</html>
