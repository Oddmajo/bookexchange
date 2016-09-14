<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Joe Sorgea">

    <title>Pricing</title>

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
        include_once('navbar.php');
    ?>

    <div class="custom-container">
        <div class="well col-lg-9">
            <form class="form-horizontal" action="" method="post" id="cartForm">
                <legend>Membership Options</legend>
                <div class="form-group">
                    <label class="col-lg-2 control-label">Website</label>
                    <div class="col-lg-10">
                        <div class="radio">
                            <label><input type="radio" name="websiteRadioGroup" value="1">Yes</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="websiteRadioGroup" value="0" checked="">No</label>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-group">
                    <label for="sessionsSelect" class="col-lg-2 control-label">Training Sessions</label>
                    <div class="col-lg-10">
                        <div class="radio">
                            <label><input type="radio" name="sessionsRadioGroup" value="0" checked="">None</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="sessionsRadioGroup" value="1">1</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="sessionsRadioGroup" value="2">4</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="sessionsRadioGroup" value="3">6</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="sessionsRadioGroup" value="4">8</label>
                        </div>
                    </div>
                </div>

                <hr>

                <div class="form-group">
                    <label for="monthsSelect" class="col-lg-2 control-label">Months</label>
                    <div class="col-lg-10">
                        <div class="radio">
                            <label><input type="radio" name="monthsRadioGroup" value="0" checked="">1</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="monthsRadioGroup" value="1">3</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="monthsRadioGroup" value="2">6</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="monthsRadioGroup" value="3">12</label>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="col-lg-3">
            <h1 class="text-center">$<span id="pricePerMonth"></span><span class="small">/month</span></h2>
            <h1 class="text-center">$<span id="totalPrice"></span><span class="small"> total</span></h2>
            <button type="submit" class="btn btn-block btn-lg btn-primary" id="checkoutButton" form="cartForm">Checkout</button>
            <button type="reset" class="btn btn-block btn-default" form="cartForm">Cancel</button>
        </div>
    </div>

    <!-- Bootstrap core JavaScript -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="bootstrap/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="bootstrap/assets/js/ie10-viewport-bug-workaround.js"></script>
    <script src="https://checkout.stripe.com/checkout.js"></script>

    <script>
        var months = [1, 3, 6, 12];
        var sessions = [0, 1, 4, 6, 8];
        // months, sessions, website
        var prices = [
            [ //1 month
                [0, 40],
		[50, 90],
                [180, 220],
                [240, 280],
                [320, 320]
            ],
            [ //3 month
                [0, 105],
		[135, 240],
                [480, 560],
                [720, 800],
                [960, 960]
            ],
            [ //6 month
                [0, 168],
		[252, 400],
                [768, 960],
                [1152, 1350],
                [1536, 1730]
            ],
            [ //12 month
                [0, 264],
		[456, 625],
                [1200, 1400],
                [1800, 2000],
                [2400, 2600]
            ]
        ];

        $( document ).ready(function() {
            UpdatePrice();
        });

        $('input[name=websiteRadioGroup]').change( UpdatePrice );
        $('input[name=monthsRadioGroup]').change( UpdatePrice );
        $('input[name=sessionsRadioGroup]').change( UpdatePrice );

        function UpdatePrice() {
            var websiteSelect = $('input[name="websiteRadioGroup"]:checked').val();
            var monthsSelect = $('input[name="monthsRadioGroup"]:checked').val();
            var sessionsSelect = $('input[name="sessionsRadioGroup"]:checked').val();
            var totalPrice = prices[monthsSelect][sessionsSelect][websiteSelect];
            document.getElementById('totalPrice').innerHTML = FormatCurrency(totalPrice);
            document.getElementById('pricePerMonth').innerHTML = FormatCurrency(totalPrice / months[monthsSelect]);
            document.getElementById('checkoutButton').disabled = (totalPrice == 0);
        }

        function FormatCurrency(number) {
            var roundedNumber = Math.ceil(number * 100) / 100;
            return roundedNumber.toFixed(2).toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
        }

        var handler = StripeCheckout.configure({
            key: 'pk_test_I5OSVEcUwr32cuZsstf2iJyw',
            image: 'images/logo.png',
            locale: 'auto',
            token: function(token) {
                // Use the token to create the charge with a server-side script.
                // You can access the token ID with `token.id`
            }
        });

        $('#checkoutButton').on('click', function(e) {
            var websiteSelect = $('input[name="websiteRadioGroup"]:checked').val();
            var monthsSelect = $('input[name="monthsRadioGroup"]:checked').val();
            var sessionsSelect = $('input[name="sessionsRadioGroup"]:checked').val();
            var totalPrice = prices[monthsSelect][sessionsSelect][websiteSelect];

            var desc = (monthsSelect > 0 ? months[monthsSelect] + " months " : "1 month ") + (websiteSelect == 1 ? "website" : "")
            + (websiteSelect != 0 && sessionsSelect > 0 ? " + " : "") + (sessionsSelect > 0 ? sessions[sessionsSelect] + " sessions/mo." : "");

            // Open Checkout with further options
            handler.open({
                name: 'Elite Level Prospects',
                description: desc,
                amount: totalPrice * 100,
            });

            e.preventDefault();
        });

        // Close Checkout on page navigation
        $(window).on('popstate', function() {
        handler.close();
        });
    </script>
</body>
