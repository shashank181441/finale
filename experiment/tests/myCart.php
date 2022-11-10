<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My CArt</title>
  <link rel="stylesheet" href="../css/bootstrap.min.css">
  <script src="../js/bootstrap.bundle.min.js"></script>
  <!-- include Google map API -->
  <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyC5Jrp9PtHe0WapppUzxbIpMDWMAcV3qE4"></script>
  <!-- include location Picker package -->
  <script src="https://unpkg.com/location-picker/dist/location-picker.min.js"></script>
  <!-- include stylesheet -->
  <link rel="stylesheet" href="../css/style.css">
</head>

<body>

  <?php
  ini_set('display_errors', 1);
  ini_set('display_startup_errors', 1);
  error_reporting(E_ALL);
  include "../dbconn.php";
  if (!isset($_SESSION['$cartItems'])) {
    // echo "No items";
  }
  ?>
  <div class="row m-3">
    <!-- <div class="col col-2"></div> -->
    <div class="col col-6">
      <table class="table col col-6">
        <?php
        $total = 0;
        $count = 0;

        foreach ($_SESSION["products"] as $products) {
          $prevID = $products['id'];
          break;
        }

        ?>
        <!-- <div class="row">
          <div class="col-6"> -->
        <?php

        foreach ($_SESSION["products"] as $products) {
          $count += 1;
          // print_r($_SESSION["products"][$products['food_name']]);

          // echo "hello";
          if ($products['id'] != $prevID) {
            echo "You have added items from two restaurants";
          }
        ?>
          <tbody>
            <tr>
              <th scope="row"><?php echo $products['food_name']; ?></th>
              <td><?php echo $products['food_price'];
                  $total += $products['food_price']; ?>
              </td>
              <td>

                <!-- <div class="collapse" id="collapseExample">
                  <textarea type="textarea" name="tarea" placeholder="your specifications" style="width:400px; "></textarea>
                </div> -->
                <form action="" method="post">
                  <button class="btn btn-primary" name="<?php echo $count; ?>"> Remove </button>
                </form>
                <?php
                if (isset($_POST[$count])) {
                  unset($_SESSION["products"][$products['food_name']]);
                  header("Location:myRestError.php");
                }

                ?>

              </td>
            </tr>
          </tbody><?php
                  $prevID = $products['id']; ?>

        <?php }
        echo "total = " . $total;
        $dolTotal=$total/100;
        echo "no. of items=" . $count . "<br>";
        ?>
      </table>

      <!-- </div> -->
      <?php

      ?>
      <script type="text/javascript">
        function show() {
          document.getElementById("tarea").style.visibility = "visible";
        }
      </script>
      <div class="row">
        <div class="col">
          <form action="../backend/orderNow.php" method="post">
            <div class="collapse" id="collapseExample">
              <textarea type="textarea" name="tarea" placeholder="your specifications" style="width:400px; "></textarea>
            </div>
            <input type="text" class="form-control" name="lat" id="lat" placeholder="lat"required>
            <input type="text" class="form-control" name="long" id="long" placeholder="long" required>
            
            <?php 
              if (isset($_SESSION["payment"])) {
                ?>
                <script>alert("payment successful");</script>
                <button type="submit" name="placeOrder" class="btn btn-primary">order Now</button><?php
              }
              else{?>
                <div id="paypal-button-container" style="width:100px; height: 50px;"></div><?php
              }
            
            
            ?>
            
  <!-- Sample PayPal credentials (client-id) are included -->
  <script src="https://www.paypal.com/sdk/js?client-id=test&currency=USD&intent=capture&disable-funding=credit,card" data-sdk-integration-source="integrationbuilder"></script>
  <!-- <script type="text/javascript" src="../js/payment.js"></script> -->
  <?php 
  $paid=0;
  include '../js/payment.php';
    
  ?>

          </form>
        </div>

        <p class="col">
          <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
            Customize
          </button>
          <br>
          
        </p>
        
      </div>
    </div>

    <div class="col-6">

      <div class="map" id="map"></div>
      <div class="show-details">
        <button class="confirm-position" id="confirm-position">Confirm Position</button>
        <p>Your Idle Position is: <span id="idle-position"></span></p>
        <p>Your confirmed Position is: <span id="confirmed-position"></span></p>
      </div>
    </div>
  </div>
  <!-- include JS file -->
  <script src="../js/main.js"></script>

</body>

</html>
<?php
// $conn2 = mysqli_connect("localhost", "root", "", "food");

// if (isset($_POST['placeOrder'])) {
//   $count2 = 0;
//   $customize = $_POST['tarea'];
//   // include "../nav/nav.php";

//   foreach ($_SESSION["products"] as $products) {
//     $c_email = $_SESSION["email"];
//     $r_id = $products["id"];
//     $f_id = $products["food_id"];
//     echo $c_email . "<br>" . $r_id . "<br>" . $f_id . "<br>";

//     $date = date('y-m-d h:i:s');
//     echo $date;
//     $count2++;

//     $sqlForOrder = " INSERT INTO `orders` (`customerEmail`, `RestaurantId`, `FoodId`,`customize`, `OrderId`,`confirm`,`date`,`deliver`) VALUES ('$c_email', '$r_id', '$f_id',`$customize`, NULL,'0','$date','0') ";
//     $results = mysqli_query($conn2, $sqlForOrder);
//     echo $sqlForOrder;
//   }
// }
// for ($i = 0; $i < $count2; $i++) {
//   unset($_SESSION['products']);
// }
?>