<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>choose Restaurant</title>
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
        <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>

    <script>
        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.watchPosition(showPosition);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }

        }

        function showPosition(position) {
            // x.innerHTML="Latitude: " + position.coords.latitude +  "<br>Longitude: " + position.coords.longitude;

            // document.getElementById("lat").value = position.coords.latitude;
            // document.getElementById("long").value = position.coords.longitude;

            document.cookie = "lati=" + position.coords.latitude;
            document.cookie = "long=" + position.coords.longitude;
            location.reload();

            console.log(cookie);
        }
    </script>

</head>

<body onload :getLocation()>
    <?php include "nav/nav.php" ?>
    <div style="width: auto; height: 80px;"></div>

    <div class="container">
        <div class="row">
            <div class="col col-3">
                <h2 class="text">Restaurants and Stores</h2>
            </div>
            <div class="col col-6 col-xs-2"></div>
            <div class="col col-3">
                <button onclick="getLocation()" class="btn btn-primary">set location</button>
                <!-- <form action="" method="post">
                    <input type="text" id="lat">Lattitude
                    <input type="text" id="long">longitude
                    <button type="submit" name="submitted">SUbmit</button>
                </form> -->

            </div>
        </div>
        <form action="" method="post">
            <input type="text" id="search" name="search" placeholder="search">
            <button class="btn btn-primary" type="submit">Search</button>
        </form>

        <?php

        ?>
        <!-- <button class="btn btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">Popularity</button>
  <ul class="dropdown-menu"><li> -->
    
        <p><a class="dropdown-item" href="chooseRestaurantByDistance.php">Distance</a></p>
  <!-- </li></ul> -->
        </div>
        <div class="border-top">
            <div class="row m-3  d-flex justify-content-center">
                <?php
                include "dbconn.php";
                // Check connection
                if (!$conn) {
                    die("Connection failed: " . mysqli_connect_error());
                }
                // $lat = $_COOKIE['lati'];
                // $long = $_COOKIE['long'];
                if (isset($_COOKIE['lati'])) {
                    $lat = $_COOKIE['lati'];
                    $long = $_COOKIE['long'];
                    $cood = $lat + $long;
                }

                // echo $lat . " " . $long;
                $filtervalues = "";
                if (isset($_POST['search'])) {
                    $filtervalues = $_POST['search'];
                }
                $sf = 3.14159 / 180; // scaling factor


                $sql = "SELECT * from add_rest order by ratingCount desc";

                $result = mysqli_query($conn, $sql);

                if (mysqli_num_rows($result) > 0) {
                    // output data of each row
                    while ($row = mysqli_fetch_assoc($result)) {

                        if (isset($_COOKIE['lati'])) {
                            $distance = abs(sqrt((pow(($row["lattitude"] - $lat), 2) + (pow(($row["longitude"] - $long), 2))))) / 0.0115165;
                        if ($distance > 20) {
                            continue;
                        }
                           
                        }
                        

                ?>
                        <div class="col col-4 text-left mx-5 my-3" style="height: 200px; width:auto;">
                            <a style="text-decoration: none;" href="myRestaurant.php?id=<?php echo $row['rest_id']; ?>">
                                <div class="row" style="height: 140px; width:240px;">
                                    <img src=" <?php echo $row["logo"] ?>" alt="error" height=100% style=" object-fit:cover; padding:0px;">
                                </div>
                                <h5 class="my-1 row"> <?php echo $row["rest_name"] ?></h5>
                                <?php if (isset($_COOKIE['lati'])) {
                                ?>
                                    <!-- <script>window.location.replace("chooseRestaurant.php");</script> -->

                                    <p class="my-1 row text-muted" style="font-size: 13px;">Distance: <?php echo round($distance, 1) . 'km' ?></p>
                                <?php
                                } ?>
                            </a>
                        </div>
                        <!-- distance according to co-ordinates difference: 1 km = 0.0115165 in co-ordinates -->
                <?php
                    }
                } else {
                    echo "0 results";
                }

                ?>

            </div>
        </div>
    </div>





    <?php include "footer.php" ?>

</body>

</html>