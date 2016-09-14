<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    function addActiveIfOnPage($requestUri) {
        $current_file_name = basename($_SERVER['REQUEST_URI'], ".php");

        if ($current_file_name == $requestUri)
            echo ' active';
    }
?>

<head>
    <link href="navbar.css" rel="stylesheet" type="text/css">
    <link href='http://fonts.googleapis.com/css?family=Russo+One|Pathway+Gothic+One' rel='stylesheet' type='text/css'>
</head>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="home.php">Elite Level Prospects</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li class="active"><a href="home.php">Home</a></li>
                <li><a href="forum.php">Coaches Forum</a></li>
                <li><a href="trainers.php">Trainers</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Prospects <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="players.php">Player Bios</a></li>
                        <li><a href="rankings.php">Top Prospects</a></li>
                        <!--
                        <li role="separator" class="divider"></li>
                        <li class="dropdown-header">Graduation Year</li>
                        <li class="dropdown-submenu">
                            <a tabindex="-1" href="rankings.php">2018</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">Specialty</li>
                                <li><a href="rankings.php#hitting">Hitting</a></li>
                                <li><a href="rankings.php#pitching">Pitching</a></li>
                                <li><a href="rankings.php#fielding">Fielding</a></li>
                                <li><a href="rankings.php#speed">Speed</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a tabindex="-1" href="#">2017</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">Specialty</li>
                                <li><a href="#">Hitting</a></li>
                                <li><a href="#">Pitching/Fielding</a></li>
                                <li><a href="#">Speed</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a tabindex="-1" href="#">2016</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">Specialty</li>
                                <li><a href="#">Hitting</a></li>
                                <li><a href="#">Pitching/Fielding</a></li>
                                <li><a href="#">Speed</a></li>
                            </ul>
                        </li>
                        <li class="dropdown-submenu">
                            <a tabindex="-1" href="#">2015</a>
                            <ul class="dropdown-menu">
                                <li class="dropdown-header">Specialty</li>
                                <li><a href="#">Hitting</a></li>
                                <li><a href="#">Pitching/Fielding</a></li>
                                <li><a href="#">Speed</a></li>
                            </ul>
                        </li>
                    -->
                    </ul>
                </li>
                <li><a href="about.php">About</a></li>
                <?php
                if (isset($_SESSION['username'])) {
                    $username = $_SESSION['username'];
                    ?>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $username; ?> <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="account.php">My Account</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">Nav header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                <?php } else { ?>
                    <li><a href="login.php">Sign In</a></li>
                <?php } ?>
            </ul>
        </div>
    </div>
</nav>
