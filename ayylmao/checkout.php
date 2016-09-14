<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="Joe Sorgea">

    <title>Checkout</title>

    <!-- Bootstrap core CSS -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/css/dropdown.css" rel="stylesheet">

    <!-- Custom styles -->
</head>

<body>
    <?php
        include_once('navbar.php');

        $price = 216.67;

        $dataKey = "pk_test_I5OSVEcUwr32cuZsstf2iJyw";
        $dataAmount = str_replace(".", "", (string) $price);
        $dataDescription = "Training ($" . $price . ")";
    ?>

    <form action="" method="POST">
        <script
        src="https://checkout.stripe.com/checkout.js" class="stripe-button"
        data-key="<?php echo $dataKey; ?>"
        data-amount="<?php echo $dataAmount; ?>"
        data-name="Elite Level Prospects"
        data-description="<?php echo $dataDescription; ?>"
        data-image="images/logo.png"
        data-locale="auto">
        </script>
    </form>
</body>
