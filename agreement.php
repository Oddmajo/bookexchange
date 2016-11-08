<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">

    

    <?php
		if(!isset($_SESSION)) 
		{
			session_start();
		}
        require_once("bootstrap-head.php");
		require_once("connect.php");
				
    ?>
	<title>About</title>
	
    <!-- Custom styles -->
    <!--<link href="commonstyles.css" rel="stylesheet" type="text/css">-->
	<link href="account.css" rel="stylesheet" type="text/css">
   
</head>
<body>
<?php
	
	include_once("navbar.php");
	
	
	
?>
<div class="container" style="margin-top:100px;">
	<div class="panel panel-default">
		<div class="panel-heading">
			Book Condition
		</div>
		<div class="panel-body">
			When you rent a textbook through CollegeShare, you may receive a new textbook or a used textbook in acceptable rental condition (See below). 
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			Returning Textbooks
		</div>
		<div class="panel-body">
			By renting a textbook through CollegeShare, you are agreeing to return it on or before the due date of May 14th.<b><font color="red">what about for fall semester</font></b>
After the first 30 days of the rental period, you may initiate a textbook return through the Your Textbook Rentals page in your CollegeShare account. We are not responsible for items that are lost in transit from you to us or for items that are sent to us in error.
When we or the owner of the textbook receives a returned textbook, we will determine in our sole discretion if it is in acceptable rental condition. If the returned textbook is determined by us not to be in acceptable rental condition, we may in our sole discretion charge you the buyout price (calculated as the full purchase price of the textbook as of the time of rental, less any rental fees and extension fees you have already paid), and ship the textbook back to you to keep.

		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			Extension Fee; Automatic Purchase
		</div>
		<div class="panel-body">
			The due date for each textbook you rent is available on the Your Textbook Rentals page in your CollegeShare account. If the rented textbook you return to us is not postmarked on or before the textbook's due date, we may in our sole discretion automatically extend your rental period by an additional 15 days and charge you the applicable 15 day extension fee for the textbook.
If, again, the rented textbook you return to us is not postmarked on or before the last date of the 15-day extended rental period, we may in our sole discretion charge you the buyout price of the textbook, and the textbook will be yours to keep.

		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			Methods of Payment
		</div>
		<div class="panel-body">
			You authorize us to charge any amounts owed by you under these Rental Terms to the card you used to rent the textbook or, if such card is no longer valid, to any other card we have on file in your CollegeShare account. You agree to maintain in your CollegeShare account at least one valid card that expires no earlier than 150 days after the date on which you rent the textbook. We reserve the right to block or cancel orders and suspend or terminate your account if you incur outstanding and unpaid fees for rented textbooks and we are not able to charge such fees to any card on file in your CollegeShare account.
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			Title and Risk of Loss
		</div>
		<div class="panel-body">
			Title to each rented textbook remains with the party from which you rented the textbook (specified on your order confirmation) during the rental period. If you elect to purchase a textbook, or if we charge you the buyout price because you did not return the textbooks in acceptable rental condition or before the extended due date, title to the textbook will pass to you when we charge you the buyout price.
Risk of loss passes to you upon our delivery of the textbook to the carrier (both for the initial shipment and for any return shipments from us to you). For returns from you to us, risk of loss passes to us upon our receipt of the textbook from the carrier.

		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			Agreement Changes
		</div>
		<div class="panel-body">
			We may in our discretion change these Rental Terms or any aspect of Textbook Rentals without notice to you. If any change is found invalid, void, or for any reason unenforceable, that change is severable and does not affect the validity and enforceability of any remaining changes or Rental Terms.
		</div>
	</div>
	<div class="panel panel-default">
		<div class="panel-heading">
			Rental Conditions
		</div>
		<div class="panel-body">
			Acceptable rental condition means:
			<ul>
				<li>No water damage (wavy, swollen or discolored, crinkled, stains, rings)</li>
				<li>No broken spine or binding</li>
				<li>Cover is not torn or taped</li>
				<li>No missing, torn, or loose pages</li>
				<li>No burns, fire, or smoke damage</li>
				<li>No strong odor of any kind (including musty odor, cigar or cigarette odor)</li>
				<li>No excessive writing or highlighting</li>
			</ul>
		If you're not satisfied with the book you receive, you can return it for a refund within 30 days of receipt. 
		</div>
	</div>
</div>





	<?php
        require_once("bootstrap-body.php");
    ?>
</body>