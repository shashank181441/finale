<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>orderNow</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/bootstrap.bundle.min.js"></script>
</head>

<body>

</body>

</html>

<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if (!isset($_SESSION["email"])) {
  header("Location:../chooseRestaurantByDistance.php");
}

$conn2 = mysqli_connect("localhost", "root", "", "food");
include "../dbconn.php";

if (isset($_POST['placeOrder'])) {
 
  $count = 0;
$custom = $_POST['tarea'];
$lat = $_POST['lat'];
$long = $_POST['long'];
  foreach ($_SESSION["products"] as $products) {
    $c_email = $_SESSION["email"];
    $r_id = $products["id"];
    $f_id = $products["food_id"];
    echo $c_email . "<br>" . $r_id . "<br>" . $f_id . "<br>";

    $date = date('y-m-d h:i:s');
    echo $date;
    $count++;

    $sqlForOrder = " INSERT INTO `orders` (`customerEmail`, `RestaurantId`, `FoodId`,`customize`,`lat`,`long`, `OrderId`,`confirm`,`date`,`deliver`) VALUES ('$c_email', '$r_id', '$f_id','$custom','$lat','$long', NULL,'0','$date','0') ";
    $results = mysqli_query($conn2, $sqlForOrder);
    echo $sqlForOrder;

    $sqlForRank = "UPDATE add_rest set `ratingCount` = `ratingCount`+1 where rest_id = $r_id";
    $result4 = mysqli_query($conn, $sqlForRank);
    echo $sqlForRank;
    
  }

}
for ($i = 0; $i < $count; $i++) {
  unset($_SESSION['products']);
  unset($_SESSION['payment']);

}

header("Location: ../myRestaurant.php?id=$r_id");
// ucfirst() // To delete a session var
// header("Location:../chooseRestaurantByDistance.php");
?>