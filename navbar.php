<head>
    <!--<link href="navbar.css" rel="stylesheet" type="text/css">-->
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
            <a class="navbar-brand" href="main.php">Book Exchange</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse" role="navigation">
            <ul class="nav navbar-nav">
                <li><a href="main.php">Home</a></li>
                <li><a href="list.php">In-Demand</a></li>
                <li class="dropdown">
                    <a href="about.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">About<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="about.php">About Us</a></li>
                        <li><a href="five-tool.php">More About Us</a></li>
                    </ul>
				</li>
				<li>
					<?php if(isset($_SESSION['email'])) { ?>
						<a href="account.php" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Account Actions<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="account.php">My Account</a></li>
						<li><a href="edit-account.php">Edit Account</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
					<?php } else { ?>
						<a href="login.php">Sign In</a>
					<?php } ?>
					</li>
            </ul>
        </div>
    </div>
</nav>
