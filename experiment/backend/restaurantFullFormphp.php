<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// check if submit button is clicked
if (!isset($_SESSION["email"])) {
?>
<script>alert("first log in");</script>
<a href="../experiment.php" class="link link-primary">Home</a>
<?php
  // header("Location: ../experiment.php");

  die;
}

//   if(isset($_POST["rest_bt"]))
// {
include "../dbconn.php";
$cust_email = $_POST["email"];
$cust_name = $_POST["cust_name"];
$sql3 = "SELECT * from add_rest where Email = '$cust_email'";
$result3 = mysqli_query($conn, $sql3);
if (mysqli_num_rows($result3) > 0) {
  // output data of each row
  while ($row = mysqli_fetch_assoc($result3)) {
    ?>
    <script>alert("You already have a restaurant with this account. Please Log in with a new account");</script>
    <a href="../experiment.php" class="link link-primary">Home</a>
    <?php

    // echo $rest_id ."<br>";
  }
}
else{
$rest_name = $_POST["rest_name"];
$details = $_POST["details"];
$lat = $_POST["lat"];
$long = $_POST["long"];
$cood = $lat + $long;
?>
<script>alert("db conn")</script>
<?php
//   upload photo
$filename = $_FILES["uploadfile"]["name"];
$tempname = $_FILES["uploadfile"]["tmp_name"];
$folder = "images/" . $filename;
echo $folder;
// move_uploaded_file($tempname, $folder);
// $myJSON = json_encode($myArr);
// upload to database
$insertquery = "INSERT INTO add_rest(Email, rest_name, logo, lattitude, longitude,details,cood_add) VALUES ('$cust_email','$rest_name','$folder','$lat','$long','$details','$cood')";
$iquery = mysqli_query($conn, $insertquery);
echo $iquery;

$insertquery1 = "UPDATE `add_rest_message` set `access` = 1 where Email = '$cust_email'";
$iquery1 = mysqli_query($conn, $insertquery1);

$sql2 = "UPDATE `registration` set `role` = 'rest_owner' where Email = '$cust_email'";
$iquery2 = mysqli_query($conn, $sql2);

header("location: food_table.php");
}

?>