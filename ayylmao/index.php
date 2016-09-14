<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Elite Level Prospects is a baseball recruitment website designed to help players be recognized by coaches and scouts, by storing up-to-date statistics on each player that are updated when players train at a participating training facility.">
    <meta name="author" content="Joe Sorgea">

    <title>Elite Level Prospects</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/dropdown.css" rel="stylesheet">

    <!-- Magnific Popup core CSS file -->
    <link rel="stylesheet" href="magnific-popup/magnific-popup.css">

    <!-- Custom styles for this template -->
    <link href="commonstyles.css" rel="stylesheet" type="text/css">
    <link href="home.css" rel="stylesheet">

    <script src="bootstrap/assets/js/ie-emulation-modes-warning.js"></script>
</head>

<body>
    <?php
        include_once('navbar.php');
    ?>

    <div id="popup-with-something" class="mfp-hide">
        <div class="some-element">
            <video width="1280" height="720" preload="auto" controls>
                <source src="videos/main.mp4" type="video/mp4">
            </video>
        </div>
    </div>

    <!-- Carousel -->
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
        <!-- Dots -->
        <ol class="carousel-indicators">
            <li class="active" data-target="#myCarousel" data-slide-to="0"></li>
            <li data-target="#myCarousel" data-slide-to="1"></li>
            <li data-target="#myCarousel" data-slide-to="2"></li>
            <li data-target="#myCarousel" data-slide-to="3"></li>
            <li data-target="#myCarousel" data-slide-to="4"></li>
            <li data-target="#myCarousel" data-slide-to="5"></li>
        </ol>
        <!-- Slides -->
        <div class="carousel-inner" role="listbox">
            <div class="item active">
                <video width="1280" height="720" autoplay muted loop>
                  <source src="videos/main.mp4" type="video/mp4">
                </video>
                <div class="container">
                    <div class="carousel-caption">
                        <h1>The Midwest's most detailed baseball recruiting website</h1>
                        <p>Our goal is to identify your individual strengths and weaknesses, while also accurately ranking and projecting your abilities to the collegiate and professional level.</p>
                        <p><a class="watch-video-link btn btn-lg btn-primary" href="#popup-with-something">Watch video</a><!--<a class="btn btn-lg btn-primary" href="#" role="button">Watch video</a>--></p>
                    </div>
                </div>
            </div>
            <div class="item">
                <video autoplay preload="auto" muted loop>
                  <source src="videos/hitting.mp4" type="video/mp4">
                </video>
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Hitting</h1>
                        <p>Approach, tempo, footwork, bat speed, and strength lay the groundwork for every successful hitter. We can help you reach your full potential and improve every aspect of your swing.</p>
                        <p><a class="btn btn-lg btn-primary" href="players.php" role="button">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="item">
                <video autoplay preload="auto" muted loop>
                  <source src="videos/fielding.mp4" type="video/mp4">
                </video>
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Fielding</h1>
                        <p>We'll help you improve your fielding skills with customized training programs designed to improve every aspect of your fielding skills.</p>
                        <p><a class="btn btn-lg btn-primary" href="players.php" role="button">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="item">
                <video autoplay preload="auto" muted loop>
                  <source src="videos/pitching.mp4" type="video/mp4">
                </video>
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Pitching</h1>
                        <p>Flexibility, mental strength, mental toughness, and velocity are all key attributes of every successful pitcher. We specialize in all of these and provide customized training programs to help you improve.</p>
                        <p><a class="btn btn-lg btn-primary" href="players.php" role="button">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="item">
                <video autoplay preload="auto" muted loop>
                  <source src="videos/coaches.mp4" type="video/mp4">
                </video>
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Coaches Forum</h1>
                        <p>The forum acts as a network for coaches and scouts to converse about potential prospects and also keeps them up to date on midwest baseball events, showcases, tryouts, etc.</p>
                        <p><a class="btn btn-lg btn-primary" href="forum.php" role="button">Learn more</a></p>
                    </div>
                </div>
            </div>
            <div class="item">
                <video autoplay preload="auto" muted loop>
                  <source src="videos/misc.mp4" type="video/mp4">
                </video>
                <div class="container">
                    <div class="carousel-caption">
                        <h1>Prospects</h1>
                        <p>Every time you train at our facilities, we'll update your profile and send coaches and scouts notifications about the areas you've improved in. We'll also rank local players using our unique formula that will help you stand out from the crowd.</p>
                        <p><a class="btn btn-lg btn-primary" href="players.php" role="button">Learn more</a></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Arrows -->
        <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
            <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
            <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        <img class="logo" src="images/logo.png" width="200" height="200" alt="Elite Level Prospects">
    </div>

    <div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <div class="row">
        <div class="col-lg-4">
            <h2>Our Mission</h2>
            <p>We want to make you the best you can be. As you train with us and improve, your stats are updated in real-time on our site. Baseball scouts get access to a list of the best players in your area. Make sure you're on that list!</p>
            <p><a class="btn btn-default" href="about.php" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-lg-4">
            <h2>Five-Tool Model</h2>
            <p>Running speed. Arm strength. Hitting for average. Hitting for power. Fielding. We rank you and your peers using our own formula that incorporates all five of these key statistics.</p>
            <p><a class="btn btn-default" href="five-tool.php" role="button">View details &raquo;</a></p>
        </div>
        <div class="col-lg-4">
            <h2>Find a Facility</h2>
            <p>Part of doing your best is training hard. We currently have 1 training facility located in Peoria, IL. Stop in for a session any time, no need for a membership--but if you want to get the word out, create an account and we'll update your profile after every training session.</p>
            <p><a class="btn btn-default" href="http://pahouseofspeed.com/" role="button">View details &raquo;</a></p>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>

    <!-- Magnific Popup core JS file -->
    <script src="magnific-popup/jquery.magnific-popup.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            $('.watch-video-link').magnificPopup({
                type: 'inline',
                midClick: true,
                mainClass: 'custom-popup-class'
            	// other options
            });
        });

        $(".nav a").on("click", function(){
            $(".nav").find(".active").removeClass("active");
            $(this).parent().addClass("active");
        });

        $('#myCarousel').carousel({
            interval: 10000
        });
    </script>
</body>
</html>
