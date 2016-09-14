<!DOCTYPE html>
<html lang="en">
<?php
// Variables for connecting to the mySQL server
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "elitelevelprospects";

// Player id
if(isset($_GET['player']))
{
	$playerId = $_GET['player'];
}

$projectionSteps = 3;


// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

function Project($data, $statNames, $steps = 3) {
	$slopes = array(); //array where stat name maps to average slope of stat
	$projections = array();
	$arraySize = count($data);

	if ($arraySize >= $steps) {
		// Find the average slope of the last <projectionSteps> entries
		foreach($statNames as $statName)
			$slopes[$statName] = 0;

		$count = 0;
		for($i = $arraySize - $steps; $i < $arraySize - 1; $i++) {
			$count++;

			$x1 = strtotime($data[$i]["date_stats_collected"]);
			$x2 = strtotime($data[$i + 1]["date_stats_collected"]);

			foreach($statNames as $statName) {
				$y1 = $data[$i][$statName];
				$y2 = $data[$i + 1][$statName];
				$slopes[$statName] += ($y2-$y1)/($x2-$x1);
			}
		}

		$i = $arraySize - 1;
		$row = array();
		$row["date_stats_collected"] = $data[$i]["date_stats_collected"];
		$timespan = strtotime($data[$arraySize - 1]["date_stats_collected"]) - strtotime($data[$arraySize - $steps]["date_stats_collected"]);
		$row2 = array();
		$row2["date_stats_collected"] = date("Y-m-d", strtotime($data[$arraySize - 1]["date_stats_collected"]) + $timespan);

		foreach($statNames as $statName) {
			$slopes[$statName] /= $count;
			$row[$statName] = $data[$i][$statName];
			$row2[$statName] = $row[$statName] + $slopes[$statName] * $timespan;
		}

		$projections[] = $row;
		$projections[] = $row2;
	}

	return $projections;
}

function WriteName($row) {
	echo $row["first_name"] . " " . $row["last_name"];// . " (" . $row["player_id"] . ")";
}

function PlotStat($array, $xAxisName, $yAxisName) {
	foreach ($array as $row) {
		echo "{ x: new Date('" . $row[$xAxisName] . "'), y: " . $row[$yAxisName] . " },";
	}
}

function ResultToArray($result) {
	$resultArray = array();
	while($row = $result->fetch_assoc()) {
		$resultArray[] = $row;
	}
	return $resultArray;
}
?>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Jacob Nash">
	
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/dropdown.css" rel="stylesheet">

    <!-- Custom styles -->
    <link href="commonstyles.css" rel="stylesheet" type="text/css">
    <link href="players.css" rel="stylesheet" type="text/css">
	<script src="tabcontent.js" type="text/javascript"></script>
    <script src="bootstrap/assets/js/ie-emulation-modes-warning.js"></script>
	<!-- Fonts -->
	<link href='http://fonts.googleapis.com/css?family=Russo+One|Pathway+Gothic+One' rel='stylesheet' type='text/css'>
	<link href='http://fonts.googleapis.com/css?family=Lato|Oswald|Montserrat' rel='stylesheet' type='text/css'>
	
	
	<?php
	if(isset($playerId))
	{
		$query = "SELECT 
				player_details.*, 
				school.*, 
				player_position.*, positions.*
				
			FROM 
				player_details, school, player_position, positions
				
				
			WHERE player_details.player_id = " . $playerId . " 
			AND player_details.school_id = school.school_id 
			AND player_position.player_id = " . $playerId . " AND positions.pos_id = player_position.pos_id";
			
			
		
		$result = $conn->query($query);
		$pedigree = $result->fetch_assoc(); // puts the first row of the table into an array
		$feet = floor($pedigree["height"] / 12);
		$inches = round(($pedigree["height"] / 12 - floor($pedigree["height"] / 12)) * 12);
		
		if($pedigree["pos_id"]=="1")
		{
			$field = "Pitching";
		}
		else
		{
			$field = "Fielding";
		}
	
	
		//Batting Stats
		$query = "SELECT q1.* 
		
			FROM batspeed_stats q1 
			LEFT OUTER JOIN batspeed_stats q2 
			ON (q1.player_id = q2.player_id AND q1.date_stats_collected < q2.date_stats_collected) 
			
			WHERE q2.player_id IS NULL AND q1.player_id = " . $playerId;
			
		$result = $conn->query($query);
		$batting = $result->fetch_assoc();
		
		//Strength Stats
		$query = "SELECT q1.* 
		
			FROM player_strength q1 
			LEFT OUTER JOIN player_strength q2 
			ON (q1.player_id = q2.player_id AND q1.date_stats_collected < q2.date_stats_collected) 
			
			WHERE q2.player_id IS NULL AND q1.player_id = " . $playerId;
			
		$result = $conn->query($query);
		$strength = $result->fetch_assoc();
		
		//Fielding Stats
		if($pedigree['pos_id']==1)
		{
			//Pitching Stats
			$query = "SELECT q1.* 
		
			FROM pitcher_stats q1 
			LEFT OUTER JOIN pitcher_stats q2 
			ON (q1.player_id = q2.player_id AND q1.date_stats_collected < q2.date_stats_collected) 
			
			WHERE q2.player_id IS NULL AND q1.player_id = " . $playerId;
		}
		else 
		{
			//Catching Stats
			$query = "SELECT q1.* 
		
				FROM catcher_stats q1 
				LEFT OUTER JOIN catcher_stats q2 
				ON (q1.player_id = q2.player_id AND q1.date_stats_collected < q2.date_stats_collected) 
				
				WHERE q2.player_id IS NULL AND q1.player_id = " . $playerId;
			
			$result = $conn->query($query);
			$catching = $result->fetch_assoc();
			
			if($pedigree['pos_id']>=2 && $pedigree['pos_id']<=6)
			{
				//Infielder Stats
				$query = "SELECT q1.* 
		
				FROM infielder_stats q1 
				LEFT OUTER JOIN infielder_stats q2 
				ON (q1.player_id = q2.player_id AND q1.date_stats_collected < q2.date_stats_collected) 
				
				WHERE q2.player_id IS NULL AND q1.player_id = " . $playerId;
			}
			else
			{
				//Outfielder Stats
				$query = "SELECT q1.* 
		
				FROM outfielder_stats q1 
				LEFT OUTER JOIN outfielder_stats q2 
				ON (q1.player_id = q2.player_id AND q1.date_stats_collected < q2.date_stats_collected) 
				
				WHERE q2.player_id IS NULL AND q1.player_id = " . $playerId;
			}
		}
		$result = $conn->query($query);
		$fielding = $result->fetch_assoc();
		
		//Speed Stats
		$query = "SELECT q1.* 

			FROM player_speed q1 
			LEFT OUTER JOIN player_speed q2 
			ON (q1.player_id = q2.player_id AND q1.date_stats_collected < q2.date_stats_collected) 
			
			WHERE q2.player_id IS NULL AND q1.player_id = " . $playerId;
		
		$result = $conn->query($query);
		$speed = $result->fetch_assoc();
		
		//Batting Graph
		$query = "SELECT *
		FROM batspeed_stats
		WHERE player_id = " . $playerId . "
		ORDER BY date_stats_collected";
		$result = $conn->query($query);
		$battingGraphData = ResultToArray($result);
		$batGraph = array("bat_speed", "exit_velocity");
		
		//Fielding Graph
		$query = "SELECT *
		FROM pitcher_stats
		WHERE player_id = " . $playerId . "
		ORDER BY date_stats_collected";
		
		$result = $conn->query($query);
		$pitchingGraphData = ResultToArray($result);
		$pitchingGraph = array("two_seem", "four_seem","changeball","curveball","slider","knuckleball");
		
		//Speed Graph
		$query = "SELECT *
		FROM player_speed
		WHERE player_id = " . $playerId . "
		ORDER BY date_stats_collected";
		
		$result = $conn->query($query);
		$speedGraphData = ResultToArray($result);
		$speedGraph = array("sixty_yard_time", "onetwenty_yard_time", "vertical_leap", "shuttle_run", "reach");
			

	}
	?>
	<?php if(isset($_GET['player'])) { ?>
    <title>Prospect: <?php echo $pedigree["first_name"]?>&nbsp<?php echo $pedigree["last_name"]?> </title>
	<?php } else { ?>
	<title>Prospect Lookup</title>
	<?php } ?>
</head>




<body>
    <?php
        $allowCoaches = true;
        $allowPlayers = true;
        require('protected.php');
        require('navbar.php');
    ?>
    <div class="content">
		<div class="bg-left">
			<div class="space">
				<img class="players" src="images/coach.jpg" style="border-color:#666666;">
				<?php
						$username = $_SESSION['username'];
				?>
				<h1 style="border-top:none;border-bottom:none;">
					<?php echo $username; ?>
				</h1>
				<ul class="sidebar">
					<li class="left">1. <img class ="sidebar" src="images/hitter.jpg">&nbsp;&nbsp;<a href="players.php?player=1&tempFollow=1&tempMod=0">John Altemus </a></li>
					<li class="left">2. <img class ="sidebar" src="images/hitter.jpg">&nbsp;&nbsp;<a href="players.php?player=2&tempFollow=1&tempMod=0">Eric Buonamici </a></li>
					<li class="left">3. <img class ="sidebar" src="images/hitter.jpg">&nbsp;&nbsp;<a href="players.php?player=3&tempFollow=1&tempMod=0">Lovell Chandler </a></li>
					<li class="left">4. <img class ="sidebar" src="images/hitter.jpg">&nbsp;&nbsp;<a href="players.php?player=4&tempFollow=1&tempMod=0">Joe Coy </a></li>
					<li class="left">5. <img class ="sidebar" src="images/hitter.jpg">&nbsp;&nbsp;<a href="players.php?player=5&tempFollow=1&tempMod=0">Scott Foltz </a></li>
					<li class="left">6. <img class ="sidebar" src="images/hitter.jpg">&nbsp;&nbsp;<a href="players.php?player=6&tempFollow=1&tempMod=0">Christopher Leopold </a></li>
					<li class="left">7. <a href="players.php"> TEST LINK</a></li>
					<li class="left">8. <a href="players.php"> TEST LINK</a></li>
					<li class="left">9. <a href="players.php"> TEST LINK</a></li>
					<li class="left">10. <a href="players.php"> TEST LINK</a></li>
				</ul>
			</div>
		</div>
		<?php if(isset($playerId)) { ?>
		<div class="main">
			<div class="space" style="margin:0px;">
				<div class="basesegment">
						<ul class="name">
							<li><?php echo $pedigree["first_name"]?>&nbsp;<?php echo $pedigree["last_name"]?></li>
							<li class="small">Bats:<?php echo $pedigree["bats"]?> /  Throws:<?php echo $pedigree["throws"]?>
							<li><?php echo $pedigree["pos_name"]?></li>
							<li class="small"><?php echo $pedigree["grad_year"]?></li>
							<li>
							<?php if(($_GET['tempMod'])==1) { ?>
								<a href="players.php">Edit Stats</a>
							<?php } else { ?>
							<a href="players.php?player=<?php echo $playerId;?>&tempFollow=<?php echo $_GET['tempFollow'] * -1?>&tempMod=0">
							<?php if($_GET['tempFollow']==1){echo "Unfollow";} else {echo "Follow";} } ?></a>
							</li>
						</ul>
					<div class="space">
						<div class="profilepicture">
							<div class="space">
								<img class="players" src="images/hitter.jpg">
							</div>
						</div>

						<div class="basestatistics">
							<div class="space">
								<ul class="profile">
									<li class="cat">Height: </li>
									<li class="stat"><?php echo $feet . "'" . $inches . '"'?></li>
									<li class="cat">Weight: </li>
									<li class="stat"><?php echo $pedigree["weight"];?> lbs</li>
									<li class="cat">Date of Birth: </li>
									<li class="stat"><?php echo $pedigree["dob"];?></li>
									<li class="cat">Graduating Year: </li>
									<li class="stat"><?php echo $pedigree["grad_year"];?></li>
									<li class="cat">School: </li>
									<li class="stat"><?php echo $pedigree["name"];?></li>
									<li class="cat">GPA: </li>
									<li class="stat"><?php echo $pedigree["gpa"];?></li>
									<li class="cat">City: </li>
									<li class="stat"><?php echo $pedigree["city"];?></li>
									<li class="cat">State: </li>
									<li class="stat"><?php echo $pedigree["state"];?></li>
									<li class="cat" style="border:none; margin:0px;">Rank: </li>
									<li class="stat" style="border:none; margin:0px;">Implement This</li>
									<li class="cat" style="border:none; margin:0px;">Rating: </li>
									<li class="stat" style="border:none; margin:0px;">Implement This</li>
								</ul>
							</div>
							<ul class="tabs">
								<li class="four"><a href="#vids">Videos</a></li>
								<li class="four"><a href="#anal">Analysis</a></li>
								<li class="four"><a href="#project">Projections</a></li>
								<li class="four selected"><a href="#default">Bio</a></li>
							</ul>
						</div>


					</div>
				</div>
				
				
				
				<div class="tabcontent" style="padding:0px;margin-top:25px;">
					<div id="default">
					</div>
					<div id="vids">
						<div class="tabbedsegment">
							<ul class="tabs">
								<li class="three"><a href="#bat1">Hitting</a></li>
								<li class="three"><a href="#ball1"><?php echo $field?></a></li>
								<li class="three"><a href="#run1">Speed</a></li>
							</ul>
							<div class="tabcontent">
								<div id="bat1">
									
										<div class="leftbox">
											<iframe width="100%" height="480" src="https://www.youtube.com/embed/wlXuqdzA1nY" frameborder="0" allowfullscreen></iframe>
										</div>
										<div class="rightbox">
											Date Updated: <?php echo $batting["date_stats_collected"]?>
											<ul class="stats">
												<li class="cat">Bat Speed:</li>
												<li class="stat"><?php echo $batting["bat_speed"]?> mph</li>
												<li class="cat">Velocity:</li>
												<li class="stat"><?php echo $batting["exit_velocity"]?> mph</li>
												<li class="cat">Bench Press:</li>
												<li class="stat"><?php echo $strength["bench_press"]?> lbs</li>
												<li class="cat">Squat:</li>
												<li class="stat"><?php echo $strength["squat"]?> lbs</li>
												<li class="cat">Dead Lift:</li>
												<li class="stat"><?php echo $strength["dead_lift"]?> lbs</li>
											</ul>
										</div>
									
								</div>
								<div id="ball1">
									
										<div class="leftbox">
											<iframe width="100%" height="480" src="https://www.youtube.com/embed/wlXuqdzA1nY" frameborder="0" allowfullscreen></iframe>
										</div>
										<div class="rightbox">
											Date Updated: <?php echo $fielding["date_stats_collected"]?>
											<?php if(($pedigree["pos_id"])==1) { ?>
											<ul class="stats">
												<li class="cat">Two Seem:</li>
												<li class="stat"><?php echo $fielding["two_seem"]?> mph</li>
												<li class="cat">Four Seem:</li>
												<li class="stat"><?php echo $fielding["four_seem"]?> mph</li>
												<li class="cat">Changeball:</li>
												<li class="stat"><?php echo $fielding["changeball"]?> mph</li>
												<li class="cat">Curveball:</li>
												<li class="stat"><?php echo $fielding["curveball"]?> mph</li>
												<li class="cat">Slider:</li>
												<li class="stat"><?php echo $fielding["slider"]?> mph</li>
												<li class="cat">Knuckleball:</li>
												<li class="stat"><?php echo $fielding["knuckleball"]?> mph</li>
											</ul>
											<?php } else { ?>
											<ul class="stats">
												<li class="cat">Throwing Speed:</li>
												<li class="stat"><?php echo $fielding["throwing_speed"]?> mph</li>
												<li class="cat">Pop Time:</li>
												<li class="stat"><?php echo $catching["pop_time"]?> seconds</li>
											</ul>
											<?php } ?>
										</div>
									
								</div>
								<div id="run1">
									
										<div class="leftbox">
											<iframe width="100%" height="480" src="https://www.youtube.com/embed/wlXuqdzA1nY" frameborder="0" allowfullscreen></iframe>
										</div>
										<div class="rightbox">
											Date Updated: <?php echo $speed["date_stats_collected"]?>
											<ul class="stats">
												<li class="cat">60 Yard Time:</li>
												<li class="stat"><?php echo $speed["sixty_yard_time"]?> seconds</li>
												<li class="cat">120 Yard Time:</li>
												<li class="stat"><?php echo $speed["onetwenty_yard_time"]?> seconds</li>
												<li class="cat">Shuttle Run:</li>
												<li class="stat"><?php echo $speed["shuttle_run"]?> seconds</li>
												<li class="cat">Vertical Leap:</li>
												<li class="stat"><?php echo $speed["vertical_leap"]?> inches</li>
												<li class="cat">Reach:</li>
												<li class="stat"><?php echo $speed["reach"]?> inches</li>
											</ul>
										</div>
									
								</div>
							</div>
						</div>
					</div>
					<div id="anal">
						<div class="tabbedsegment">
							<ul class="tabs">
								<li class="three"><a href="#bat2">Hitting</a></li>
								<li class="three"><a href="#ball2"><?php echo $field?></a></li>
								<li class="three"><a href="#run2">Speed</a></li>
							</ul>
							<div class="tabcontent">
								<div id="bat2">
									<div class="leftbox">
											<canvas id="battingGraph" width="800px" height="480px"></canvas>
										</div>
										<div class="rightbox">
											<ul class="stats">
												<li class="cat">Bat Speed:</li>
												<li class="stat"style="color:#8dc8e0;"><?php echo $batting["bat_speed"]?> mph</li>
												<li class="cat">Velocity:</li>
												<li class="stat"style="color:#029EDC;"><?php echo $batting["exit_velocity"]?> mph</li>
												<li class="cat">Bench Press:</li>
												<li class="stat"><?php echo $strength["bench_press"]?> lbs</li>
												<li class="cat">Squat:</li>
												<li class="stat"><?php echo $strength["squat"]?> lbs</li>
												<li class="cat">Dead Lift:</li>
												<li class="stat"><?php echo $strength["dead_lift"]?> lbs</li>
											</ul>
										</div>
								</div>
								<div id="ball2">
									<div class="leftbox">
											<canvas id="pitchingGraph" width="800px" height="480px"></canvas>
										</div>
										<div class="rightbox">
											<?php if(($pedigree["pos_id"])==1) { ?>
											<ul class="stats">
												<li class="cat">Two Seem:</li>
												<li class="stat"style="color:#8dc8e0;"><?php echo $fielding["two_seem"]?> mph</li>
												<li class="cat">Four Seem:</li>
												<li class="stat"style="color:#029EDC;"><?php echo $fielding["four_seem"]?> mph</li>
												<li class="cat">Changeball:</li>
												<li class="stat"style="color:#5edee5;"><?php echo $fielding["changeball"]?> mph</li>
												<li class="cat">Curveball:</li>
												<li class="stat"style="color:#c9c9c9;"><?php echo $fielding["curveball"]?> mph</li>
												<li class="cat">Slider:</li>
												<li class="stat"style="color:#ffffff;"><?php echo $fielding["slider"]?> mph</li>
												<li class="cat">Knuckleball:</li>
												<li class="stat"style="color:#00bfa5;"><?php echo $fielding["knuckleball"]?> mph</li>
											</ul>
											<?php } else { ?>
											<ul class="stats">
												<li class="cat">Throwing Speed:</li>
												<li class="stat"><?php echo $fielding["throwing_speed"]?> mph</li>
												<li class="cat">Pop Time:</li>
												<li class="stat"><?php echo $catching["pop_time"]?> seconds</li>
											</ul>
											<?php } ?>
										</div>
								</div>
								<div id="run2">
									<div class="leftbox">
											<canvas id="speedGraph" width="800px" height="480px"></canvas>
										</div>
										<div class="rightbox">
											<ul class="stats">
												<li class="cat">60 Yard Time:</li>
												<li class="stat"style="color:#8dc8e0;"><?php echo $speed["sixty_yard_time"]?> seconds</li>
												<li class="cat">120 Yard Time:</li>
												<li class="stat"style="color:#029EDC;"><?php echo $speed["onetwenty_yard_time"]?> seconds</li>
												<li class="cat">Shuttle Run:</li>
												<li class="stat"style="color:#5edee5;"><?php echo $speed["shuttle_run"]?> seconds</li>
												<li class="cat">Vertical Leap:</li>
												<li class="stat"><?php echo $speed["vertical_leap"]?> inches</li>
												<li class="cat">Reach:</li>
												<li class="stat"><?php echo $speed["reach"]?> inches</li>
											</ul>
										</div>
								</div>
							</div>
						</div>
					</div>
					<div id="project">
						<div class="tabbedsegment">
							<ul class="tabs">
								<li class="three"><a href="#bat3">Hitting</a></li>
								<li class="three"><a href="#ball3"><?php echo $field?></a></li>
								<li class="three"><a href="#run3">Speed</a></li>
							</ul>
							<div class="tabcontent">
								<div id="bat3">
									<div class="leftbox">
										PROJECTIONS TO BE IMPLEMENTED
									</div>
									<div class="rightbox">
										PROJECTIONS TO BE IMPLEMENTED
										<ul class="stats">
											<li class="cat">Bat Speed:</li>
											<li class="stat"><?php echo $batting["bat_speed"]?> mph</li>
											<li class="cat">Velocity:</li>
											<li class="stat"><?php echo $batting["exit_velocity"]?> mph</li>
											<li class="cat">Bench Press:</li>
											<li class="stat"><?php echo $strength["bench_press"]?> lbs</li>
											<li class="cat">Squat:</li>
											<li class="stat"><?php echo $strength["squat"]?> lbs</li>
											<li class="cat">Dead Lift:</li>
											<li class="stat"><?php echo $strength["dead_lift"]?> lbs</li>
										</ul>
									</div>
								</div>
								<div id="ball3">
									<div class="leftbox">
										PROJECTIONS TO BE IMPLEMENTED
									</div>
									<div class="rightbox">
										PROJECTIONS TO BE IMPLEMENTED
										<?php if(($pedigree["pos_id"])==1) { ?>
										<ul class="stats">
											<li class="cat">Two Seem:</li>
											<li class="stat"><?php echo $fielding["two_seem"]?> mph</li>
											<li class="cat">Four Seem:</li>
											<li class="stat"><?php echo $fielding["four_seem"]?> mph</li>
											<li class="cat">Changeball:</li>
											<li class="stat"><?php echo $fielding["changeball"]?> mph</li>
											<li class="cat">Curveball:</li>
											<li class="stat"><?php echo $fielding["curveball"]?> mph</li>
											<li class="cat">Slider:</li>
											<li class="stat"><?php echo $fielding["slider"]?> mph</li>
											<li class="cat">Knuckleball:</li>
											<li class="stat"><?php echo $fielding["knuckleball"]?> mph</li>
										</ul>
										<?php } else { ?>
										<ul class="stats">
											<li class="cat">Throwing Speed:</li>
											<li class="stat"><?php echo $fielding["throwing_speed"]?> mph</li>
											<li class="cat">Pop Time:</li>
											<li class="stat"><?php echo $catching["pop_time"]?> seconds</li>
										</ul>
										<?php } ?>
									</div>
								</div>
								<div id="run3">
									<div class="leftbox">
										PROJECTIONS TO BE IMPLEMENTED
									</div>
									<div class="rightbox">
										PROJECTIONS TO BE IMPLEMENTED
										<ul class="stats">
											<li class="cat">60 Yard Time:</li>
											<li class="stat"><?php echo $speed["sixty_yard_time"]?> seconds</li>
											<li class="cat">120 Yard Time:</li>
											<li class="stat"><?php echo $speed["onetwenty_yard_time"]?> seconds</li>
											<li class="cat">Shuttle Run:</li>
											<li class="stat"><?php echo $speed["shuttle_run"]?> seconds</li>
											<li class="cat">Vertical Leap:</li>
											<li class="stat"><?php echo $speed["vertical_leap"]?> inches</li>
											<li class="cat">Reach:</li>
											<li class="stat"><?php echo $speed["reach"]?> inches</li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php if($usertype == 'coach') { ?>
				<div class="commentsegment">
					<div class="space" style="margin:10px;">
						<div class="detailBox">
							<div class="titleBox">
							  <label>Comment Box</label>
							</div>
							<div class="actionBox">
								<ul class="commentList">
									<li>
										<div class="commenterImage">
										  <img src="http://lorempixel.com/50/50/people/6" />
										</div>
										<div class="commentText">
											<p class="">I saw this player in a match a few weeks ago - pretty good.</p> <span class="date sub-text">on July 5th, 2014</span>

										</div>
									</li>
									<li>
										<div class="commenterImage">
										  <img src="http://lorempixel.com/50/50/people/7" />
										</div>
										<div class="commentText">
											<p class="">Has quite a bit to work on, but he is defiinitely improving.  Has anyone spoken to him in person and gotten a good impression of him?</p> <span class="date sub-text">on August 5th, 2014</span>

										</div>
									</li>
									<li>
										<div class="commenterImage">
										  <img src="http://lorempixel.com/50/50/people/9" />
										</div>
										<div class="commentText">
											<p class="">He has a good attitude from what I've seen.</p> <span class="date sub-text">on August 6th, 2014</span>

										</div>
									</li>
								</ul>
								<form class="form-inline" role="form">
									<div class="form-group">
										<input class="form-control" type="text" placeholder="Your comments" />
									</div>
									<div class="form-group">
										<button class="btn btn-default">Add</button>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
				<?php } ?>
			</div>
		</div>
		<div class="bg-right"style="height:100%;">
			<div class="space"style="height:100%;">
				<img class="players" src="images/logo.png" style="border:none;">
				<div class="input-group">
					<input type="text" class="form-control" placeholder="Search Prospects">
					<span class="input-group-btn">
						<button class="btn btn-default" type="button">Go!</button>
					</span>
				</div>
				<div class="sidebarsegment" style="background:none;border:none;">
					<ul class="sidebar" style="height:100%;">
						<li class="dropdown" style="text-align:center;">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">2018 <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="players.php">Hitting</a></li>
								<li><a href="players.php">Pitching/Fielding</a></li>
								<li><a href="players.php">Speed</a></li>
							</ul>
						</li>
						<li class="dropdown" style="text-align:center;">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">2017 <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="players.php">Hitting</a></li>
								<li><a href="players.php">Pitching/Fielding</a></li>
								<li><a href="players.php">Speed</a></li>
							</ul>
						</li>
						<li class="dropdown" style="text-align:center;">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">2016 <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="players.php">Hitting</a></li>
								<li><a href="players.php">Pitching/Fielding</a></li>
								<li><a href="players.php">Speed</a></li>
							</ul>
						</li>
						<li class="dropdown" style="text-align:center;">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">2015 <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="players.php">Hitting</a></li>
								<li><a href="players.php">Pitching/Fielding</a></li>
								<li><a href="players.php">Speed</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		
	<?php } else { ?>
	
		<div class="main">
			<div class="space" style="margin:0px;">
				<div class="search"style="float:left;">
				</div>
				<div class="search"style="display:inline-block;width:26%;">
					<img class="players" src="images/logo.png" style="border:none;height:100%;">
				</div>
				<div class="search"style="float:right;">
				</div>
				<div class="space"style="margin-left:250px;margin-right:250px;">
					<div class="input-group">
						<input type="text" class="form-control" placeholder="Search Prospects">
						<span class="input-group-btn">
							<button class="btn btn-default" type="button">Go!</button>
						</span>
					</div>
					<ul class="search">
						<li class="dropdown" style="width:25%;">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">2015 <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="players.php">Hitting</a></li>
								<li><a href="players.php">Pitching/Fielding</a></li>
								<li><a href="players.php">Speed</a></li>
							</ul>
						</li>
						<li class="dropdown" style="width:25%;">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">2016 <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="players.php">Hitting</a></li>
								<li><a href="players.php">Pitching/Fielding</a></li>
								<li><a href="players.php">Speed</a></li>
							</ul>
						</li>
						<li class="dropdown" style="width:25%;">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">2017 <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="players.php">Hitting</a></li>
								<li><a href="players.php">Pitching/Fielding</a></li>
								<li><a href="players.php">Speed</a></li>
							</ul>
						</li>
						<li class="dropdown" style="width:25%;">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">2018 <span class="caret"></span></a>
							<ul class="dropdown-menu">
								<li><a href="players.php">Hitting</a></li>
								<li><a href="players.php">Pitching/Fielding</a></li>
								<li><a href="players.php">Speed</a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="bg-right">
			<div class="space">
				
			</div>
		</div>
	<?php } ?>		
    </div>

    <!-- Bootstrap core JavaScript -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="bootstrap/assets/js/ie-emulation-modes-warning.js"></script>
    <!-- Custom js libraries -->
    <script type="text/javascript" src="tablesorter/js/jquery.tablesorter.js"></script>
    <script src="Chart.js/Chart.min.js"></script>
    <script src="Chart.Scatter.js/Chart.Scatter.min.js"></script>
	
	<script>
        $(document).ready(function(){
            $(function(){
                $("table").tablesorter();
				
				var optionsMPH = {
					scaleFontColor : "#ffffff",
					scaleGridLineColor: "#656565",
					scaleLineColor: "#656565",
                    bezierCurve: false,
                    scaleType: "date",
                    scaleDateFormat: "mmm",
                    scaleDateTimeFormat: "mmm d, yyyy",
                    scaleLabel: "<%=value%> mph"
                };
				var optionsSEC = {
					scaleFontColor : "#ffffff",
					scaleGridLineColor: "#656565",
					scaleLineColor: "#656565",
                    bezierCurve: false,
                    scaleType: "date",
                    scaleDateFormat: "mmm",
                    scaleDateTimeFormat: "mmm d, yyyy",
                    scaleLabel: "<%=value%> sec"
                };
				
                var battingCTX = $("#battingGraph").get(0).getContext("2d");
                var battingData = [
                    {
                        label: 'Bat speed',
                        strokeColor: "#8dc8e0",
                        pointColor: "#8dc8e0",
                        data: [
                            <?php
                            PlotStat($battingGraphData, "date_stats_collected", "bat_speed");
                            ?>
                        ]
                    },
                    {
                        label: 'Exit velocity',
                        strokeColor: "#029EDC",
                        pointColor: "#029EDC",
                        data: [
                            <?php
                            PlotStat($battingGraphData, "date_stats_collected", "exit_velocity");
                            ?>
                        ]
                    },
                ];
				var myBattingChart = new Chart(battingCTX).Scatter(battingData, optionsMPH);
				
				<?php if($pedigree["pos_id"]==1) { ?>
				var pitchingCTX = $("#pitchingGraph").get(0).getContext("2d");
                var pitchingData = [
                    {
                        label: 'Two Seem',
                        strokeColor: "#8dc8e0",
                        pointColor: "#8dc8e0",
                        data: [
                            <?php
                            PlotStat($pitchingGraphData, "date_stats_collected", "two_seem");
                            ?>
                        ]
                    },
                    {
                        label: 'Four Seem',
                        strokeColor: "#029EDC",
                        pointColor: "#029EDC",
                        data: [
                            <?php
                            PlotStat($pitchingGraphData, "date_stats_collected", "four_seem");
                            ?>
                        ]
                    },
					{
                        label: 'Changeball',
                        strokeColor: "#5edee5",
                        pointColor: "#5edee5",
                        data: [
                            <?php
                            PlotStat($pitchingGraphData, "date_stats_collected", "changeball");
                            ?>
                        ]
                    },
                    {
                        label: 'Curveball',
                        strokeColor: "#c9c9c9",
                        pointColor: "#c9c9c9",
                        data: [
                            <?php
                            PlotStat($pitchingGraphData, "date_stats_collected", "curveball");
                            ?>
                        ]
                    },
					{
                        label: 'Slider',
                        strokeColor: "#ffffff",
                        pointColor: "#ffffff",
                        data: [
                            <?php
                            PlotStat($pitchingGraphData, "date_stats_collected", "slider");
                            ?>
                        ]
                    },
                    {
                        label: 'Knuckleball',
                        strokeColor: "#00bfa5",
                        pointColor: "#00bfa5",
                        data: [
                            <?php
                            PlotStat($pitchingGraphData, "date_stats_collected", "knuckleball");
                            ?>
                        ]
                    },
                ];
				var myPitchingingChart = new Chart(pitchingCTX).Scatter(pitchingData, optionsMPH);
				<?php } ?>
				
				var speedCTX = $("#speedGraph").get(0).getContext("2d");
                var speedData = [
                    {
						label: '60 Yard Dash',
                        strokeColor: "#8dc8e0",
                        pointColor: "#8dc8e0",
                        data: [
                            <?php
                            PlotStat($speedGraphData, "date_stats_collected", "sixty_yard_time");
                            ?>
                        ]
                    },
                    {
                        label: '120 Yard Dash',
                        strokeColor: "#029EDC",
                        pointColor: "#029EDC",
                        data: [
                            <?php
                            PlotStat($speedGraphData, "date_stats_collected", "onetwenty_yard_time");
                            ?>
                        ]
                    },
					{
                        label: 'Shuttle Run',
                        strokeColor: "#5edee5",
                        pointColor: "#5edee5",
                        data: [
                            <?php
                            PlotStat($speedGraphData, "date_stats_collected", "shuttle_run");
                            ?>
                        ]
                    },
                ];
				var mySpeedChart = new Chart(speedCTX).Scatter(speedData, optionsSEC);
				
				
                ctx = $("#myRadarChart").get(0).getContext("2d");
                data = {
                    labels: ["Running Speed", "Arm Strength", "Hitting for Average", "Hitting for Power", "Fielding"],
                    datasets: [
                        {
                            label: "Five-Tool Model",
                            fillColor: "rgba(2, 158, 220, 0.2)",
                            strokeColor: "rgba(2, 158, 220, 1)",
                            pointColor: "rgba(2, 158, 220, 1)",
                            pointStrokeColor: "#fff",
                            pointHighlightFill: "#fff",
                            pointHighlightStroke: "rgba(220,220,220,1)",
                            data: [0.75, 0.9, 0.7, 0.65, 0.6]
                        }
                    ]
                }
                options = {
					// String - Colour of the grid lines
					scaleGridLineColor: "rgba(220,220,220,1)",
					
                    //Boolean - Whether to show lines for each scale point
                    scaleShowLine : true,

                    //Boolean - Whether we show the angle lines out of the radar
                    angleShowLineOut : true,

                    //Boolean - Whether to show labels on the scale
                    scaleShowLabels : false,

                    // Boolean - Whether the scale should begin at zero
                    scaleBeginAtZero : true,
					
					scaleFontColor : "#ffffff",

                    //String - Colour of the angle line
                    angleLineColor : "rgba(0,0,0,.1)",

                    //Number - Pixel width of the angle line
                    angleLineWidth : 1,

                    //String - Point label font declaration
                    pointLabelFontFamily : "'Arial'",

                    //String - Point label font weight
                    pointLabelFontStyle : "normal",

                    //Number - Point label font size in pixels
                    pointLabelFontSize : 10,

                    //String - Point label font colour
                    pointLabelFontColor : "#666",

                    //Boolean - Whether to show a dot for each point
                    pointDot : true,

                    //Number - Radius of each point dot in pixels
                    pointDotRadius : 3,

                    //Number - Pixel width of point dot stroke
                    pointDotStrokeWidth : 1,

                    //Number - amount extra to add to the radius to cater for hit detection outside the drawn point
                    pointHitDetectionRadius : 20,

                    //Boolean - Whether to show a stroke for datasets
                    datasetStroke : true,

                    //Number - Pixel width of dataset stroke
                    datasetStrokeWidth : 2,

                    //Boolean - Whether to fill the dataset with a colour
                    datasetFill : true,

                    //String - A legend template
                    legendTemplate : "<ul class=\"<%=name.toLowerCase()%>-legend\"><% for (var i=0; i<datasets.length; i++){%><li><span style=\"background-color:<%=datasets[i].strokeColor%>\"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>"

                }
                var myRadarChart = new Chart(ctx).Radar(data, options);
                // bind to sort events
                $("table")
                .bind("sortStart",function(e, table) {
                    $("table#" + e.target.id + " > thead > tr > th").removeClass("sorted-column");
                });

                $("th").click(function() {
                    $(this).addClass("sorted-column");
                });
            });
        });
    </script>
</body>