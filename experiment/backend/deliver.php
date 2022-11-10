<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>deliver</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
    
</body>
</html>

<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SESSION["role"] != "delivery") {
    header("Location: ../experiment.php");
}
$orderId = $_GET["OrderId"];
// $rest_id = $_GET["rest_id"];
// $cust_email = $_GET["cust_email"];
// $date = $_GET["date"];

// echo $rest_id."<br>";
// echo $cust_email."<br>";
// echo $date."<br>";

$conn2 = mysqli_connect("localhost", "root", "", "food");

// $sqlForFoodName = "SELECT * from rest_$rest_id where FoodId = ".$row['FoodId'];
$sql3 = "SELECT * from orders where OrderId = '$orderId'";
$result3 = mysqli_query($conn2, $sql3);
if (mysqli_num_rows($result3) > 0) {
    // output data of each row
    while ($row3 = mysqli_fetch_assoc($result3)) {
        $cust_email = $row3["customerEmail"];
        $rest_id = $row3["RestaurantId"];
        $date = $row3["date"];




        $sql = "SELECT * from orders where customerEmail = '$cust_email' AND RestaurantId =$rest_id AND date ='$date'";
        // echo $sql;
        $result = mysqli_query($conn2, $sql);
        echo $cust_email;

        if (mysqli_num_rows($result) > 0) {
            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                // print_r($row);
                $sqlForFoodName = "SELECT * from rest_$rest_id where food_id = " . $row['FoodId'];
                // echo $sqlForFoodName;
                $deliver="";
                $result1 = mysqli_query($conn2, $sqlForFoodName);
                if (mysqli_num_rows($result1) > 0) {
                    // output data of each row
                    while ($row1 = mysqli_fetch_assoc($result1)) {
                        $food_name = $row1["food_name"];
                        echo '<br>' . $food_name;
                        
                        // echo  "<br>";
                    }
                }
                $deliver = $row["deliver"];

    }
    echo '<br>';
    echo $deliver;
    if ($deliver == '0' ) {
        // if ($_SESSION["role"] == "delivery") 
        {

?>
<form action="" method="post">
    <button class="btn btn-primary" type="submit" name="confirm">I will deliver</button>
</form>

<?php
        }
    } 
    else if($deliver == $_SESSION["role"]){
        ?><a href="../deliveryPanel.php">Delivery Panel</a>
    <?php }
    else {
        // echo $_SESSION["role"];
        echo "taken";
        // header("Location: ../experiment.php");
        
    }
}
$d_email = $_SESSION["email"];
if (isset($_POST["confirm"])) {

    $sql2 = "UPDATE orders set deliver = '$d_email' where customerEmail = '$cust_email' and RestaurantId = $rest_id and date = '$date'";
    $result2 = mysqli_query($conn2, $sql2);
    }}
}
?>