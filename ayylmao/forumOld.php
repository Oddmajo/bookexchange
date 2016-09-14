<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Jacob Nash">

    <title>Coaches Forum</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/dropdown.css" rel="stylesheet">

    <!-- Custom styles -->
    <!--<link href="commonstyles.css" rel="stylesheet" type="text/css">-->
    <link href="forum.css" rel="stylesheet" type="text/css">

    <script src="bootstrap/assets/js/ie-emulation-modes-warning.js"></script>
</head>

<body>
    <?php
        $allowCoaches = true;
        require('protected.php');
        include_once('navbar.php');
    ?>
<div class="custom-container">
<div class="row">
<div class="col-md-3">
    <h4>Profile</h4>
</div>
<div class="col-md-6">
    <ul class="nav nav-tabs">
          <li class="active"><a href="#">Players</a></li>
          <li><a href="#">Teams</a></li>
          <li><a href="#">Upcoming Events</a></li>
    </ul>

    <form class="panel panel-default">
        <div class="panel-body">
            <textarea class="form-control" rows="5" id="comment"></textarea>
        </div>
        <div class="panel-footer">
            <button class="btn btn-primary" type="submit">Post</button>
        </div>
    </form>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="media-left">
                <img class="media-object" src="images/hitter.jpg" width="64" height="64">
            </div>
            <div class="media-body">
                <h4 class="media-heading">One of my athletes just hit 2 home runs in a single game</h4>
                Lorem ipsum dolor sit amet, sit blandit adipisci adversarium in. Mucius nemore ceteros duo cu, iuvaret facilisi principes cum no, cu sumo tibique postulant has. In hinc epicurei eos. Per suas diceret nusquam ne, eu denique repudiandae sea. Vis ei esse honestatis. Labitur iuvaret fastidii eum no. His civibus definiebas vituperatoribus cu, ex fastidii suscipiantur sea, vel ne quando viderer.
            </div>
        </div>
        <div class="panel-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default">Show comments (4)</button>
                </div>
                <div class="btn-group" role="group">
                    <a href="players.php" role="button" class="btn btn-default">Go to player bio</a>
                </div>
            </div>
        </div>
    </div>

    <div class="panel panel-default">
        <div class="panel-body">
            <div class="media-left">
                <img class="media-object" src="images/pitcher.jpg" width="64" height="64">
            </div>
            <div class="media-body">
                <h4 class="media-heading">I just scouted a game where this kid threw a near-perfect game</h4>
                Lorem ipsum dolor sit amet, sit blandit adipisci adversarium in. Mucius nemore ceteros duo cu, iuvaret facilisi principes cum no, cu sumo tibique postulant has. In hinc epicurei eos. Per suas diceret nusquam ne, eu denique repudiandae sea. Vis ei esse honestatis. Labitur iuvaret fastidii eum no. His civibus definiebas vituperatoribus cu, ex fastidii suscipiantur sea, vel ne quando viderer.
            </div>
        </div>
        <div class="panel-footer">
            <div class="btn-group btn-group-justified" role="group" aria-label="...">
                <div class="btn-group" role="group">
                    <button type="button" class="btn btn-default">Show comments (4)</button>
                </div>
                <div class="btn-group" role="group">
                    <a href="players.php" role="button" class="btn btn-default">Go to player bio</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-md-3">
    <h4>Options</h4>
</div>
</div>
</div>
        <!--
    	<div class="space">
    		<div class="post">
    			<div class="space">
    				<h1> One of my athletes just hit 2 home runs in a single game </h1>
    				<div class="leftpic">
    					<div class="space">
    						<img class="forum" src="images/hitter.jpg">
    					</div>
    				</div>
    				<div class="righttext">
    					<div class = "space">
    						<h2>
    						Name: Roll Fizzlebeef <br><br>
    						Age: 16 <br><br>
    						Height: 5ft 10in <br><br>
    						Weight: 140 <br><br>
    						</h2>
    					</div>
    				</div>
    			</div>
    		</div>
    	</div>
    	<div class="space">
    		<div class="post">
    			<div class="space">
    				<h1> I just scouted a game where this kid threw a near-perfect game </h1>

    				<div class="lefttext">
    					<div class="space">
    						<h2>
    						Name: Big McLargehuge <br><br>
    						Age: 18 <br><br>
    						Height: 6ft 2in <br><br>
    						Weight: 190 <br><br>
    						</h2>
    					</div>
    				</div>

    				<div class="rightpic">
    					<div class="space">
    						<img class="forum" src="images/pitcher.jpg">
    					</div>
    				</div>

    			</div>
    		</div>
    	</div>

    </div>

    <div class="bg-right">
    	<div class="space">
    		<h1 class="small">
    			This will be a checkbox
    		</h1>
    	</div>
    </div>
    </div>
-->
    <!-- Bootstrap core JavaScript -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
