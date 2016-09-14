<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="author" content="Joe Sorgea">

    <title>Top Prospects</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/dropdown.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <!-- <link href="commonstyles.css" rel="stylesheet" type="text/css"> -->

    <style>
        .sorted-column {
            color: #029EDC;
        }

        select {
            width: 100px !important;
        }
    </style>
</head>

<body>
    <?php
        $allowCoaches = true;
        //require('protected.php');
        include_once('navbar.php');

        // Variables for connecting to the mySQL server
        $hostname = "localhost";
        $username = "dbadmin";
        $password = "testing";//Lrz9RPVb7zPH2aTA";
        $dbname = "elitelevelprospects";

        // Player id
        $playerId = 10;

        // Projections
        $projectionSteps = 3;

        // Hitting ranking
        define("BAT_SPEED_GOOD", "85");
        define("BAT_SPEED_BAD", "60");
        define("EXIT_VELOCITY_GOOD", "95");
        define("EXIT_VELOCITY_BAD", "70");

        // Speed ranking
        define("SIXTY_YARD_GOOD", "6.5");
        define("SIXTY_YARD_BAD", "7.5");
        define("ONETWENTY_YARD_GOOD", "15.5");
        define("ONETWENTY_YARD_BAD", "16.5");
        define("VERTICAL_LEAP_GOOD", "30");
        define("VERTICAL_LEAP_BAD", "25");
        define("SHUTTLE_RUN_GOOD", "5");
        define("SHUTTLE_RUN_BAD", "10");
        define("REACH_GOOD", "70");
        define("REACH_BAD", "60");

        // Create connection
        $conn = new mysqli($hostname, $username, $password, $dbname);
        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $query = "SELECT bat_speed, exit_velocity, player_id, date_stats_collected
        FROM batspeed_stats
        WHERE player_id = " . $playerId . "
        ORDER BY date_stats_collected";
        $result = $conn->query($query);
        if (!$result) {
            throw new Exception("Database Error [{$conn->errno}] {$conn->error}");
        }
        $lineGraphData = ResultToArray($result);
        $statNames = array("bat_speed", "exit_velocity");
        $lineGraphProjections = Project($lineGraphData, $statNames, 3);

        RankPlayers($conn);

        function RankPlayers($conn) {
            $query = "SELECT score, bat_speed, exit_velocity, batspeed_id
            FROM batspeed_stats";
            $result = $conn->query($query);
            if (!$result) {
                throw new Exception("Database Error [{$conn->errno}] {$conn->error}");
            }
            $array = RankHitting($result);

            foreach($array as $row) {
                $query = "UPDATE batspeed_stats
                SET score = " . $row["score"] . "
                WHERE batspeed_id = " . $row["batspeed_id"];
                $result = $conn->query($query);
                if (!$result) {
                    throw new Exception("Database Error [{$conn->errno}] {$conn->error}");
                }
            }

            $query = "SELECT score, sixty_yard_time, onetwenty_yard_time, vertical_leap, shuttle_run, reach, player_speed_id
            FROM player_speed";
            $result = $conn->query($query);
            if (!$result) {
                throw new Exception("Database Error [{$conn->errno}] {$conn->error}");
            }
            $array = RankSpeed($result);

            foreach($array as $row) {
                $query = "UPDATE player_speed
                SET score = " . $row["score"] . "
                WHERE player_speed_id = " . $row["player_speed_id"];
                $result = $conn->query($query);
                if (!$result) {
                    throw new Exception("Database Error [{$conn->errno}] {$conn->error}");
                }
            }
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
            echo $row["last_name"] . ", " . $row["first_name"];
        }

        function WriteScore($row) {
            echo $row["rank"];// . " " . FormatDebug("(" . $row["score"] . ")");
        }

        function FormatTime($time) {
            if ($time != "")
                echo $time . " " . FormatLabel("s");
        }

        function FormatSpeed($speed) {
            if ($speed != "")
                echo $speed . " " . FormatLabel("mph");
        }

        function FormatLength($length) {
            if ($length != "")
                echo $length . " " . FormatLabel("in");
        }

        function FormatWeight($weight) {
            if ($weight != "")
                echo $weight . " " . FormatLabel("lb");
        }

        function FormatLabel($string) {
            return "<span class=\"text-muted\">" . $string . "</span>";
        }

        function FormatDebug($string) {
            return "<code>" . $string . "</code>";
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

        function Rank($array) {
            $size = count($array);
            if ($size == 0)
                return $array;

            $currentRank = 1;
            $array[0]["rank"] = $currentRank;

            for($i = 1; $i < $size; $i++) {
                if ($array[$i]["score"] != $array[$i-1]["score"])
                    $currentRank++;
                $array[$i]["rank"] = $currentRank;
            }

            return $array;
        }

        function Normalize($array, $columnName) {
            if (count($array) == 1) {
                $array[0][$columnName] = 1.00;
                return $array;
            }

            // Find max and min values in <$columnName> column
            $min = $array[0][$columnName];
            $max = $array[0][$columnName];
            foreach($array as $row) {
                $value = $row[$columnName];
                if ($value > $max)
                    $max = $value;
                if ($value < $min)
                    $min = $value;
            }

            foreach ($array as &$row) {
                $row[$columnName] = InverseLerp($row[$columnName], $max, $min);
            }

            return $array;
        }

        function RankHitting($result) {
            $array = array();
            while($row = $result->fetch_assoc()) {
                $row["score"] = InverseLerp($row["bat_speed"], BAT_SPEED_GOOD, BAT_SPEED_BAD)
                + InverseLerp($row["exit_velocity"], EXIT_VELOCITY_GOOD, EXIT_VELOCITY_BAD);
                $array[] = $row;
            }

            return $array;
        }

        function RankSpeed($result) {
            $array = array();
            while($row = $result->fetch_assoc()) {
                $row["score"] = InverseLerp($row["sixty_yard_time"], SIXTY_YARD_GOOD, SIXTY_YARD_BAD)
                + InverseLerp($row["onetwenty_yard_time"], ONETWENTY_YARD_GOOD, ONETWENTY_YARD_BAD)
                + InverseLerp($row["vertical_leap"], VERTICAL_LEAP_GOOD, VERTICAL_LEAP_BAD)
                + InverseLerp($row["shuttle_run"], SHUTTLE_RUN_GOOD, SHUTTLE_RUN_BAD)
                + InverseLerp($row["reach"], REACH_GOOD, REACH_BAD);
                $array[] = $row;
            }

            return $array;
        }

        function InverseLerp($value, $max, $min) {
            return ($value - $min) / ($max - $min);
        }
    ?>
    <div class="container">
        <div class="alert alert-info">
            <span class="glyphicon glyphicon-info-sign" aria-hidden="true"></span>
            <span class="sr-only">Tip:</span>
            To sort the table by a column, click the column title you want to sort by.
        </div>

        <form class="form-inline" action="?selected=1" method="post">
            <div class="form-group">
                <label>Graduation Year </label>
                <select class="form-control" id="gradYearSelect" name="gradYear">
                      <option>2011</option>
                      <option>2010</option>
                      <option>2009</option>
                </select>
                <label> See stats for </label>
                <select class="form-control" id="tableTypeSelect" name="tableType">
                      <option value="hitting">Hitting</option>
                      <option value="pitching">Pitching</option>
                      <option value="fielding">Fielding</option>
                      <option value="speed">Speed</option>
                </select>
                <button class="btn btn-primary" type="submit">Go</button>
            </div>
        </form>
<!--
        <h2>Hitting</h2>
        <canvas id="myChart" width="800" height="400"></canvas>
        <h2>Five-Tool Model <span class="small">Rating: 3.6</span></h2>
        <canvas id="myRadarChart" width="400" height="300"></canvas>
    -->

        <?php
            if (isset($_GET["selected"])) {
                $gradYear = $_POST["gradYear"];
                $tableType = $_POST["tableType"];

                if ($tableType == "hitting") {
        ?>
        <h2 id="hitting">Hitting</h2>
        <table class="table table-striped table-hover tablesorter" id="hittingTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <!-- <span class="glyphicon glyphicon-chevron-up"> -->
                    <th class="sortInitialOrder-asc lockedOrder-asc sorted-column">Rank</th>
                    <th class="lockedOrder-desc">Bat speed</th>
                    <th class="lockedOrder-desc">Exit velocity</th>
                    <th class="lockedOrder-desc">Bench press</th>
                    <th class="lockedOrder-desc">Deadlift</th>
                    <th class="lockedOrder-desc">Squat</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // query the player details and bat speed tables and select the latest bat speed entry for each player, then order the table by bat speed
                    $query = "SELECT first_name, last_name, b3.bat_speed, b3.exit_velocity, b3.score, ps3.bench_press, ps3.dead_lift, ps3.squat
                    FROM player_details

                    LEFT JOIN (
                        SELECT b1.*
                    	FROM batspeed_stats b1
                    	WHERE b1.date_stats_collected = (
                            SELECT MAX(b2.date_stats_collected)
                        	FROM batspeed_stats b2
                            WHERE b2.player_id = b1.player_id
                        )
                    ) b3
                    ON player_details.player_id = b3.player_id

                    LEFT JOIN (
                        SELECT ps1.*
                    	FROM player_strength ps1
                    	WHERE ps1.date_stats_collected = (
                            SELECT MAX(ps2.date_stats_collected)
                        	FROM player_strength ps2
                            WHERE ps2.player_id = ps1.player_id
                        )
                    ) ps3
                    ON player_details.player_id = ps3.player_id

                    WHERE ((batspeed_id IS NOT NULL) AND player_details.grad_year = '" . $gradYear . "')

                    ORDER BY b3.score DESC";
                    $result = $conn->query($query);
                    if (!$result) {
                        throw new Exception("Database Error [{$conn->errno}] {$conn->error}");
                    }
                    $array = Rank(ResultToArray($result));

                    foreach($array as $row) {
                        ?>
                        <tr>
                            <td><?php WriteName($row)?></td>
                            <td><?php WriteScore($row)?></td>
                            <td><?php echo FormatSpeed($row["bat_speed"])?></td>
                            <td><?php echo FormatSpeed($row["exit_velocity"])?></td>
                            <td><?php echo FormatWeight($row["bench_press"])?></td>
                            <td><?php echo FormatWeight($row["dead_lift"])?></td>
                            <td><?php echo FormatWeight($row["squat"])?></td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>

        <?php
                } else if ($tableType == "pitching") {
        ?>
        <h2 id="pitching">Pitching</h2>
        <table class="table table-striped table-hover tablesorter" id="pitchingTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th class="lockedOrder-desc sorted-column">Curveball</th>
                    <th class="lockedOrder-desc">Changeup</th>
                    <th class="lockedOrder-desc">Two-seam</th>
                    <th class="lockedOrder-desc">Four-seam</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // query the player details and bat speed tables and select the latest bat speed entry for each player, then order the table by bat speed
                    $query = "SELECT first_name, last_name, p3.curveball, p3.changeball, p3.two_seem, p3.four_seem
                    FROM player_details

                    LEFT JOIN (
                        SELECT p1.*
                    	FROM pitcher_stats p1
                    	WHERE p1.date_stats_collected = (
                            SELECT MAX(p2.date_stats_collected)
                        	FROM pitcher_stats p2
                            WHERE p2.player_id = p1.player_id
                        )
                    ) p3
                    ON player_details.player_id = p3.player_id

                    WHERE ((pitcher_id IS NOT NULL) AND player_details.grad_year = '" . $gradYear . "')

                    ORDER BY p3.curveball DESC";
                    $result = $conn->query($query);
                    if (!$result) {
                        throw new Exception("Database Error [{$conn->errno}] {$conn->error}");
                    }

                    while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php WriteName($row)?></td>
                            <td><?php echo FormatSpeed($row["curveball"])?></td>
                            <td><?php echo FormatSpeed($row["changeball"])?></td>
                            <td><?php echo FormatSpeed($row["two_seem"])?></td>
                            <td><?php echo FormatSpeed($row["four_seem"])?></td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>

        <?php
                } else if ($tableType == "fielding") {
        ?>
        <h2 id="fielding">Fielding</h2>
        <table class="table table-striped table-hover tablesorter" id="fieldingTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th class="lockedOrder-desc sorted-column">Throwing speed</th>
                    <th class="lockedOrder-asc">Pop time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // query the player details and bat speed tables and select the latest bat speed entry for each player, then order the table by bat speed
                    $query = "SELECT first_name, last_name, f3.throwing_speed, c3.pop_time
                    FROM player_details

                    LEFT JOIN (
                        SELECT f1.*
                    	FROM fielding_stats f1
                    	WHERE f1.date_stats_collected = (
                            SELECT MAX(f2.date_stats_collected)
                        	FROM fielding_stats f2
                            WHERE f2.player_id = f1.player_id
                        )
                    ) f3 ON player_details.player_id = f3.player_id

                    LEFT JOIN (
                        SELECT c1.*
                    	FROM catcher_stats c1
                    	WHERE c1.date_stats_collected = (
                            SELECT MAX(c2.date_stats_collected)
                        	FROM catcher_stats c2
                            WHERE c2.player_id = c1.player_id
                        )
                    ) c3 ON player_details.player_id = c3.player_id

                    WHERE ((fielder_id IS NOT NULL OR catcher_id IS NOT NULL) AND player_details.grad_year = '" . $gradYear . "')

                    ORDER BY f3.throwing_speed DESC";
                    $result = $conn->query($query);
                    if (!$result) {
                        throw new Exception("Database Error [{$conn->errno}] {$conn->error}");
                    }

                    while($row = $result->fetch_assoc()) {
                        ?>
                        <tr>
                            <td><?php WriteName($row)?></td>
                            <td><?php echo FormatSpeed($row["throwing_speed"])?></td>
                            <td><?php echo FormatTime($row["pop_time"])?></td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>

        <?php
    } else if ($tableType == "speed") {
        ?>
        <h2 id="speed">Speed</h2>
        <table class="table table-striped table-hover tablesorter" id="speedTable">
            <thead>
                <tr>
                    <th>Name</th>
                    <th class="sortInitialOrder-asc lockedOrder-asc sorted-column">Rank</th>
                    <th class="lockedOrder-asc">60 yard time</th>
                    <th class="lockedOrder-asc">120 yard time</th>
                    <th class="lockedOrder-desc">Vertical leap</th>
                    <th class="lockedOrder-asc">Shuttle run</th>
                    <th class="lockedOrder-desc">Reach</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    // query the player details and bat speed tables and select the latest bat speed entry for each player, then order the table by bat speed
                    $query = "SELECT first_name, last_name, t3.player_id, score, sixty_yard_time, onetwenty_yard_time, vertical_leap, shuttle_run, reach
                    FROM player_details

                    JOIN (
                        SELECT t1.*
                        FROM player_speed t1
                        WHERE t1.date_stats_collected = (
                            SELECT MAX(t2.date_stats_collected)
                            FROM player_speed t2
                            WHERE t2.player_id = t1.player_id
                        )
                    ) t3 ON player_details.player_id = t3.player_id

                    WHERE player_details.grad_year = '" . $gradYear . "'

                    ORDER BY score DESC";
                    $result = $conn->query($query);
                    if (!$result) {
                        throw new Exception("Database Error [{$conn->errno}] {$conn->error}");
                    }
                    $array = Rank(ResultToArray($result));

                    foreach($array as $row) {
                        ?>
                        <tr>
                            <td><?php WriteName($row)?></td>
                            <td><?php WriteScore($row)?></td>
                            <td><?php echo FormatTime($row["sixty_yard_time"])?></td>
                            <td><?php echo FormatTime($row["onetwenty_yard_time"])?></td>
                            <td><?php echo FormatLength($row["vertical_leap"])?></td>
                            <td><?php echo FormatTime($row["shuttle_run"])?></td>
                            <td><?php echo FormatLength($row["reach"])?></td>
                        </tr>
                        <?php
                    }
                ?>
            </tbody>
        </table>
        <?php
                }
            }
        ?>
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
    <script src="Chart.js/Chart.js"></script>
    <script src="Chart.Scatter.js/Chart.Scatter.js"></script>

    <script>
        window.onload = function() {
            /*
            var ctx = document.getElementById("myChart").getContext("2d");
            var data = [
                {
                    label: 'Projected bat speed',
                    strokeColor: "rgba(220, 220, 220, 1)",
                    pointColor: "rgba(220, 220, 220, 1)",
                    data: [
                        <?php
                        PlotStat($lineGraphProjections, "date_stats_collected", "bat_speed");
                        ?>
                    ]
                },
                {
                    label: 'Projected exit velocity',
                    strokeColor: "rgba(220, 220, 220, 1)",
                    pointColor: "rgba(220, 220, 220, 1)",
                    data: [
                        <?php
                        PlotStat($lineGraphProjections, "date_stats_collected", "exit_velocity");
                        ?>
                    ]
                },
                {
                    label: 'Bat speed',
                    strokeColor: "rgba(2, 158, 220, 1)",
                    pointColor: "rgba(2, 158, 220, 1)",
                    data: [
                        <?php
                        PlotStat($lineGraphData, "date_stats_collected", "bat_speed");
                        ?>
                    ]
                },
                {
                    label: 'Exit velocity',
                    strokeColor: "#F16220",
                    pointColor: "#F16220",
                    data: [
                        <?php
                        PlotStat($lineGraphData, "date_stats_collected", "exit_velocity");
                        ?>
                    ]
                },
            ];
            var options = {
                bezierCurve: false,
                useUtc: true,
                scaleType: "date",
                scaleDateFormat: "mmm",
                scaleDateTimeFormat: "mmmm d, yyyy",
                scaleLabel: "<%=value%> mph",
            };
            var myScatterChart = new Chart(ctx).Scatter(data, options);

            ctx = $("#myRadarChart").get(0).getContext("2d");
            var data = {
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
            };
            var options = {
                //Boolean - Whether to show lines for each scale point
                scaleShowLine : true,

                //Boolean - Whether we show the angle lines out of the radar
                angleShowLineOut : true,

                //Boolean - Whether to show labels on the scale
                scaleShowLabels : false,

                // Boolean - Whether the scale should begin at zero
                scaleBeginAtZero : true,

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

            };
            var myRadarChart = new Chart(ctx).Radar(data, options);
            */
            <?php if (isset($_GET["selected"])) { ?>
            document.getElementById('gradYearSelect').value = "<?php echo $_POST['gradYear'];?>";
            document.getElementById('tableTypeSelect').value = "<?php echo $_POST['tableType'];?>";
            <?php } ?>

            $("table").tablesorter();

            // bind to sort events
            $("table").bind("sortStart",function(e, table) {
                $("table#" + e.target.id + " > thead > tr > th").removeClass("sorted-column");
            });

            $("th").click(function() {
                $(this).addClass("sorted-column");
            });
        };
    </script>
</body>
