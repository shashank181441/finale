<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Panel</title>
    <!-- include Google map API -->
    <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5Jrp9PtHe0WapppUzxbIpMDWMAcV3qE4"></script>
    <!-- include location Picker package -->
    <script src="https://unpkg.com/location-picker/dist/location-picker.min.js"></script>
    <!-- include stylesheet -->
    <link rel="stylesheet" href="css/style.css">

</head>

<body>
    <?php
    $deli_lat=$_COOKIE["lati"];
    $deli_long=$_COOKIE["long"];
    include "nav/nav.php";
    // session_start();
    include "dbconn.php";
    $conn2 = mysqli_connect("localhost", "root", "", "food");
    $email = $_SESSION["email"];
    // echo $email;
    $cust_email="" ;
    $rest_id=$cust_lat=$cust_long=$order_id=0;
    $sql = "SELECT * FROM orders WHERE deliver='$email'";
    $result = mysqli_query($conn2, $sql);
    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            $cust_email = $row['customerEmail'];
            $rest_id = $row['RestaurantId'];
            $cust_lat = $row['lat'];
            $cust_long = $row['long'];
            $order_id = $row['OrderId'];
            $date=$row['date'];
            break;
        }
    }

    $cust_name="";
    $sql1 = "SELECT * FROM registration WHERE Email='$cust_email' ";
    $result1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($result1) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result1)) {
            $cust_name = $row["FirstName"] . " " . $row["LastName"];
        }
    }
    $sql2 = "SELECT * FROM add_rest WHERE rest_id='$rest_id' ";
    $result2 = mysqli_query($conn, $sql2);
    $rest_name="";
    $rest_lat=$rest_long=0;
    if (mysqli_num_rows($result2) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result2)) {
            $rest_name = $row["rest_name"];
            $rest_lat = $row["lattitude"];
            $rest_long = $row["longitude"];
        }
    }
    //     echo "<br>" . $cust_email;
    // echo $rest_id;
    // echo $rest_lat;
    // echo $rest_long;
    // echo "<br>" ;
    //     echo $cust_name;
    //     echo $rest_name;
    ?>
    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col col-3"></div> -->
            <div class="col col-md-6 col-sm-8 col-xs-10">
                <table class="table table-striped text-center">
                    <!-- <tr>
            <td><img src="images/foodpick.jpg" alt="image" height="50px" width="50px"></td>
        </tr> -->
                    <tr>
                        <td class=" "><?php echo $rest_name; ?></td>
                        <td class=" "><?php echo $cust_name; ?></td>
                    </tr>
                    <tr>
                        <td class=" "><a  href="https://www.google.com/maps/dir/'<?php echo $deli_lat?>,<?php echo $deli_long?>'/<?php echo $rest_lat?>,<?php echo $rest_long?>/"><button class="btn btn-primary loc" onclick="rest()">Go to Restaurant</button></a></td>
                        
	</a>
                        <td class=" "><a href="https://www.google.com/maps/dir/'<?php echo $deli_lat?>,<?php echo $deli_long?>'/<?php echo $cust_lat?>,<?php echo $cust_long?>/"><button class="btn btn-primary loc" onclick="cust()">Go to Customer</button></a></td>
                        
	</a>
                    </tr>

                </table>
                <!-- <h6 id="addName"></h6> -->
                <!-- <div class="map" id="map"></div> -->
            </div>
        </div>
    </div>

    <!-- <script>
        // get reference of elements
        map = document.getElementById('map');
        confirm_position_btn = document.getElementsByClassName('loc');
        idle_position = document.getElementById('idle-position');
        // confirm_position = document.getElementById('confirmed-position');

        // initialize location picker plugin

        var latti, longi, temp = 1;

        function rest() {
            latti = <?php echo $rest_lat ?>;
            longi = <?php echo $rest_long ?>;
            temp = 0;
            //  document.write(latti);
        }

        function cust() {
            latti = <?php echo $cust_lat ?>;
            longi = <?php echo $cust_long ?>;
            temp = 1
        }

        function locate() {
            if (temp == 0) {
                document.getElementById("addName").innerHTML ="Restaurant";
                let ip = new locationPicker(map, {
                    setCurrentPosition: true,
                    lat: <?php echo $rest_lat ?>,
                    lng: <?php echo $rest_long ?>
                    
                }, {
                    zoom: 15
                })

            } else {
                document.getElementById("addName").innerHTML ="Customer";
                
                let ip = new locationPicker(map, {
                    setCurrentPosition: true,
                    lat: <?php echo $cust_lat ?>,
                    lng: <?php echo $cust_long ?>
                }, {
                    zoom: 15
                })

            }
            setTimeout(locate, 500000);

        }
        locate();



        // onbutton click
        // confirm_position_btn.onclick = function() {
        //     let location = ip.getMarkerPosition();
        //     confirm_position.innerHTML = location.lat + "," + location.lng;
        //     document.getElementById("lat").value = location.lat;
        //     document.getElementById("long").value = location.lng;
        // }

        // show coords when user interact with map
        google.maps.event.addListener(ip.map, 'idle', function(event) {
            let location = ip.getMarkerPosition();
            idle_position.innerHTML = "Lattitude: " + location.lat + " Longitude: " + location.lng;

            // document.cookie = "latt = " + location.lat;
            // document.cookie = "long = " + location.lng;
        })
    </script> -->





    <form   method="post" action="">
        <button class="btn btn-primary" name="delivered">Delivered</button>
</form>
<?php
    if (isset($_POST['delivered'])) {
        // $sql8 = "UPDATE orders set deliver='done' where date='$date'";
        $sql8 = "DELETE FROM orders where date='$date'";
        $result8 = mysqli_query($conn2, $sql8);
        ?>
        <script>
            window.location.href = "experiment.php";
        </script>
        <!-- header("Location:experiment.php"); -->
        <?php
    }


?>
 
</body>

</html>