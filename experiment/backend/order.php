<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


$cust_email = $_GET["cust_email"];
$rest_id = $_GET["rest_id"];
$date = $_GET["date"];
echo $cust_email;
echo $rest_id; 
echo $date;?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order</title>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.min.css">
    <script src="../js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <?php include "../nav/nav.php"; ?>

</body>

</html>
<?php
$conn2 = mysqli_connect("localhost", "root", "", "food");

// $sqlForFoodName = "SELECT * from rest_$rest_id where FoodId = ".$row['FoodId'];


$sql = "SELECT * from orders where customerEmail = $cust_email AND RestaurantId =$rest_id AND date ='$date'";
// echo $sql;
$result = mysqli_query($conn2, $sql);
echo $cust_email;
echo $cust_email;
echo $rest_id; 
echo $date;

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while ($row = mysqli_fetch_assoc($result)) {
        // print_r($row);
        $sqlForFoodName = "SELECT * from rest_$rest_id where food_id = " . $row['FoodId'];
        // echo $sqlForFoodName;
        $conf=0;
        $result1 = mysqli_query($conn2, $sqlForFoodName);
        echo $sqlForFoodName;
        if (mysqli_num_rows($result1) > 0) {
            // output data of each row
            while ($row1 = mysqli_fetch_assoc($result1)) {
                $food_name = $row1["food_name"];
                echo '<br>' . $food_name;
                $conf = $row["confirm"];
                // echo  "<br>";
            }
        }
    }
    echo '<br>';
    echo $conf;
    if ($conf != 1) {
        if ($_SESSION["role"] == "rest_owner") {

?>
<form action="" method="post">
    <button class="btn btn-primary" type="submit" name="confirm">Confirm</button>
</form>

<?php
        }
    } else {
        echo "order confirmed";
    }
}


?>
<!-- <form action="" method="post">
    <button class="btn btn-primary" type="submit" name="confirm">Confirm</button>
</form> -->

<?php
// $sql4 = "select * from orders where customerEmail = $cust_email and RestaurantId = $rest_id ";
// $result4 = mysqli_query($conn2, $sql4);
// if (mysqli_num_rows($result) > 0) {
//     // output data of each row
//     while ($row = mysqli_fetch_assoc($result)) {

//     }
// }


if (isset($_POST["confirm"])) {

    $sql2 = "UPDATE orders set confirm = 1 where customerEmail = $cust_email and RestaurantId = $rest_id and date='$date'";
    $result2 = mysqli_query($conn2, $sql2);
}


?>

<?php 
      $date = date('y-m-d h:i:s');
      echo $date; ?>