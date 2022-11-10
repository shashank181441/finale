<?php
session_start();
$email = $_SESSION['email'];
echo $email;
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MEssgaes</title>
    <style>
        a.good {
            text-decoration: none;
        }
    </style>
</head>

<body>
    <?php
    include "nav/nav.php";
    
    include "dbconn.php";
    // $conn = mysqli_connect("localhost", "root","","food_ordering_system");
    $sql1 = "SELECT * from add_rest where Email = '$email'";
    $result1 = mysqli_query($conn, $sql1);
    // echo $sql1;
    $count = 0;
    if (mysqli_num_rows($result1) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result1)) {
            $rest_id = $row["rest_id"];
            // echo $rest_id ."<br>";
        }
    }

    $conn2 = mysqli_connect("localhost", "root", "", "food");

    if ($_SESSION["role"] == "rest_owner") {

        $sql = "SELECT * from orders where RestaurantId = '$rest_id' and deliver!='done' order by 'OrderId' DESC";
        $result = mysqli_query($conn2, $sql);
        // echo $sql;
        $temp = "";
        $tempDate = "";
        // echo mysqli_num_rows($result);

        if (mysqli_num_rows($result) > 0) {

            // output data of each row
            while ($row = mysqli_fetch_assoc($result)) {
                $count++;
                // echo $count;

                $cust_email = $row["customerEmail"];
                $dates = $row["date"];
                // $rest_id;

                if ($row["customerEmail"] != $temp || $row["date"] != $tempDate) {
                    // if ($row["deliver"] == 0) {
                    $a1 = "primary";
                    $a0 = "secondary";

                    if ($row["confirm"] == 0) { ?>
                        <div class="p-3 bg-info text-white">
                        <?php
                    } else { ?>
                            <div class="p-3 bg-secondary text-white">
                            <?php
                        }
                            ?>

                            <a class="good link link-light" href="backend/order.php?cust_email='<?php echo $cust_email ?>'&rest_id=<?php echo $rest_id ?>&date=<?php echo $row["date"] ?>">
                                <?php echo "Food order from " . $cust_email;
                                echo $row['date']; ?>
                            </a>
                            </div>
                <?php
                    // echo "hello";
                    echo "<br>";
                    $temp = $cust_email;
                    $tempDate = $dates;
                    // }
                }
            }
        }
        // $sql8 = "SELECT * from add_rest_message where `access` = 1";
        // $result8 = mysqli_query($conn, $sql8);
        // if (mysqli_num_rows($result8) > 0) {
        //     
                ?>
                <!-- // <a href="resttaurantFullForm.php">Start your restaurant </a> -->
                // <?php
                    // }
                    // echo $count;
                }
                //If customer is logged in
                elseif ($_SESSION["role"] == "customer") {

                    $sql3 = "SELECT * from orders where CustomerEmail = '$email' and confirm = 1";
                    $result2 = mysqli_query($conn2, $sql3);
                    // echo $sql3;
                    $prevRest='';
                    if (mysqli_num_rows($result2) > 0) {
                        // output data of each row
                        while ($row = mysqli_fetch_assoc($result2)) {
                            if ($row["RestaurantId"] != $prevRest || $row["date"] != $tempDate) {

                                $prevRest = $row["RestaurantId"]; ?>
                            <div class="p-3 bg-info text-white">
                                <?php
                                echo "Your order from " . $row["RestaurantId"] . "confirmed.  "; ?></div>
                    <?php
                            }
                        }
                    }
                } elseif ($_SESSION["role"] == "delivery") {
                    $sql = "SELECT * FROM orders WHERE confirm = 1 and deliver='$email'";
                    $result = mysqli_query($conn2, $sql);
                    if (mysqli_num_rows($result) > 0) {
                        // include "deliveryPanel.php";
                        // header("location: deliverypanel.php");
                        ?>
                        <script>
                            window.location.replace("deliveryPanel.php");
                        </script>
                        <?php
                          
                    } else {


                        $sql5 = "SELECT * from orders where confirm = 1 and deliver = '0'";
                        $result5 = mysqli_query($conn2, $sql5);
                        // echo $sql5;
                        $prevRest = "";
                        $tempDate = "";
                        $count = 0; ?>


                    <!-- <button class="btn btn-primary" onclick="getLocation()">Share My Location</button> -->

                    <!-- <p id="demo"></p> -->

                    <script>
                        var x = document.getElementById("demo");

                        function getLocation() {
                            if (navigator.geolocation) {
                                navigator.geolocation.getCurrentPosition(showPosition);
                            } else {
                                x.innerHTML = "Geolocation is not supported by this browser.";
                                document.write("hello");
                            }
                        }
                        getLocation();

                        function showPosition(position) {
                            // x.innerHTML = "Latitude: " + position.coords.latitude +         "<br>Longitude: " + position.coords.longitude;
                            document.cookie = "lati=" + position.coords.latitude;
                            document.cookie = "long=" + position.coords.longitude;
                            // location.reload();
                            <?php 
                                if(isset($_COOKIE["lati"])){
                                    ?>
                                    // location.reload();
                                    <?php
                                }
                            ?>
                        }
                    </script>
                    <?php
                        $lat = $_COOKIE['lati'];
                        $long = $_COOKIE['long'];
                        if (mysqli_num_rows($result5) > 0) {
                            // output data of each row
                            while ($row = mysqli_fetch_assoc($result5)) {

                                if ($row["RestaurantId"] != $prevRest || $row["date"] != $tempDate) {

                                    $count++;
                                    $prevRest = $row["RestaurantId"];
                                    $rest_id = $row["RestaurantId"];
                                    $lat = $_COOKIE['lati'];
                                    $long = $_COOKIE['long'];
                                    // // if (isset($_COOKIE['lati'])) {
                                    $sql4 = "SELECT *,(sqrt((pow((lattitude-$lat),2)+(pow((longitude-$long),2)))))/0.0115165 AS distance FROM add_rest where  rest_id='$rest_id' ORDER BY distance";
                                    // // }else{
                                    // $sql4 = "SELECT * from add_rest where rest_id='$rest_id'";
                                    // // }
                                    $result4 = mysqli_query($conn, $sql4);

                                    if (mysqli_num_rows($result4) > 0) {
                                        // output data of each row
                                        while ($row4 = mysqli_fetch_assoc($result4)) {
                                            $distance = (sqrt((pow(($row4["lattitude"] - $lat), 2) + (pow(($row4["longitude"] - $long), 2))))) / 0.0115165;
                                            // print_r($row4);
                                            $rest_name = $row4["rest_name"];
                                            $lat = $row4["lattitude"];
                                            $long = $row4["longitude"];
                                        }
                                    }
                                    $cust_email = $row["customerEmail"];
                                    $orderId = $row["OrderId"];
                                    $tempDate = $row["date"];

                    ?><div class="p-3 m-1 bg-info text-white"> <a class="good link link-light" href="backend/deliver.php?OrderId=<?php echo $orderId; ?>">
                                        <?php echo  $rest_name . " is searching for delivery " . round($distance, 1) . " km away <br>"; ?>
                                    </a></div>
                        <?php
                                }
                            }
                        }
                        if ($count == 0) {
                            echo "No new orders";
                        }
                    }
                } else if ($_GET["email"] == "admin@g.com") {
                    $sql7 = "SELECT * from `add_rest_message` where access != 1";
                    echo $sql7;
                    ?>
                    <script>alert(<?php echo $sql7?>)</script>
                    
                    <?php
                    $result7 = mysqli_query($conn, $sql7);
                    echo $sql7;

                    if (mysqli_num_rows($result7) > 0) {
                        while ($row = mysqli_fetch_assoc($result7)) {
                        ?>
                        <div class="row">
                            <div class="col-10 bg-light mx-3 my-2 p-2">
                                <?php
                                echo "      " . $row['Name'] . " has requested to add his restaurant";
                                ?></div>
                            <p class="col"> <a href="restaurantFullForm.php?email=<?php echo $row['email']; ?>&rest_name=<?php echo $row['rest_name']; ?>">
                            <button class="btn btn-primary">Open form</button></a> </p>
                        </div>
            <?php
                        }
                    }
                }
            ?>
            <?php include "footer.php"; ?>
</body>

</html>