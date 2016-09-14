<?php
$hostname="localhost";
$username="dbadmin";
$password="testing";//Lrz9RPVb7zPH2aTA";
$dbname="elitelevelprospects";

// Player id
$playerId = 1;

// Create connection
$conn = new mysqli($hostname, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$query = "SELECT first_name, last_name, dob, grad_year, height, weight, throws, bats, player_details.school_id, school.school_id, school.name
FROM player_details, school
WHERE player_id = " . $playerId . " AND player_details.school_id = school.school_id";
$result = $conn->query($query);
if (!$result) {
    throw new Exception("Database Error [{$conn->errno}] {$conn->error}");
}

$row = $result->fetch_assoc(); // puts the first row of the table into an array
$schoolId = $row["school_id"];
$feet = floor($row["height"] / 12);
$inches = round(($row["height"] / 12 - floor($row["height"] / 12)) * 12);
$birthDate = str_replace("-", "/", $row["dob"]);
//get age from date or birthdate
$age = DateTime::createFromFormat('Y/m/d', $birthDate)->diff(new DateTime('now'))->y;
?>

First name: <?php echo $row["first_name"]?><br>
Last name: <?php echo $row["last_name"]?><br>
Date of birth: <?php echo "{$row["dob"]} (Age {$age})"?><br>
Grad year: <?php echo $row["grad_year"]?><br>
Height: <?php echo $feet . "'" . $inches . '"'?><br>
Weight: <?php echo $row["weight"]?> lb<br>
Throws: <?php echo $row["throws"]?><br>
Bats: <?php echo $row["bats"]?><br>
City/State: <?php echo $row["city"]?>, <?php echo $row["state"]?><br>
School: <?php echo $row["name"]?>, <?php echo $row["school_city"]?>, <?php echo $row["school_state"]?><br>

<?php
$conn->close();
?>
