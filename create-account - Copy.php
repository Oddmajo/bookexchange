<?php
session_start();
require_once("connect.php");

/*if (isset($_GET["submit"])) 
{
    unset($_GET["submit"]);

    $ok = true;
    $success = false;

    $query = $conn->prepare("SELECT account_id FROM user_login WHERE username = ? LIMIT 1");
    $query->bind_param("s", $_POST["username"]);
    $query->execute();
    $query->store_result();
    $query->bind_result($accountId);
    $query->fetch();
    if ($query->num_rows == 1) {
        AddError("Username taken.");
        $ok = false;
    }

    $query = $conn->prepare("SELECT account_id FROM user_login WHERE email_id = ? LIMIT 1");
    $query->bind_param("s", $_POST["email"]);
    $query->execute();
    $query->store_result();
    $query->bind_result($accountId);
    $query->fetch();
    if ($query->num_rows == 1) {
        AddError("Email taken.");
        $ok = false;
    }

    if ($_POST["password"] !== $_POST["confirmPassword"]) {
        AddError("Passwords don't match.");
        $ok = false;
    }

    // Insert user into user_login table
    if ($ok) {
        $salt = GenerateSalt();
        $password = SaltPassword($_POST["password"], $salt);
        $roleType = 1;

        if ($query = $conn->prepare("INSERT INTO user_login (username, password, email_id, salt, created_at, updated_at, role_type)
        VALUES (?, ?, ?, ?, NOW(), NOW(), {$roleType})")) {
            $query->bind_param("ssss", $_POST["username"], $password, $_POST["email"], $salt);
            $result = $query->execute();
            if ($result === false)
                AddError("An unknown error occurred when inserting your account details into the database.");
            else
                $success = true;
        } else
            AddError("An unknown error occurred when creating your account.");
    }

    if ($success)
        header("location: login.php");
}*/
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
    <div class="container">
        <?php
            WriteErrorsHTML();
        ?>
        <h2>Create An Account</h2>
        <form action="?submit=1" method="post">
            <div class="form-group">
                <label for="text">Username:</label>
                <input type="text" class="form-control" name="username" id="text" placeholder="username" maxlength="25" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password" placeholder="password" maxlength="25" required>
            </div>
            <div class="form-group">
                <label for="confirmPassword">Confirm Password:</label>
                <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" placeholder="password" maxlength="25" required>
            </div>
            <div class="form-group">
                <label for="email">Email address:</label>
                <input type="email" class="form-control" name="email" id="email" placeholder="test@example.com" maxlength="70" required>
            </div>
            <button type="submit" class="btn btn-primary">Create account</button>
        </form>
        <br>
        <p><b>Note:</b> For prospective players only. Players must be 12 or older to train, and 14 or older to display their information on the website.</p>
    </div>

    <?php
        require_once("bootstrap-body.php");
    ?>
</body>
</html>
