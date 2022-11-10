<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="css/style.css">

  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

  <title>Hello, world!</title>
</head>

<body>
  <?php require 'nav/nav.php' ?>


  <div class="line" style="width: 100vw;">
    <div class='searchh center' style="top: 240px; left: 50%; transform: translate(-50%,0%); position: absolute">
      <p class="aboveSearch">Order food from the wildest range of restaurants.</p>
      <div class="searchBox">
        <form action="chooseRestaurantByDistance.php" method="post">
          <input type="text" class="searchFood" name="search" placeholder="search">
          <button style="background-color: black; color:yellow; padding: 5px;margin-left: 4px;" type="submit">Find Food</button>
        </form>
      </div>
    </div>
  </div>


  <div class="container my-3">
    <div class="row pt-2 pb-1">
      <div class="col-auto">
        <p>Featured Restaurant</p>
      </div>
      <div class="col"></div>
      <div class="col-auto">
        <a class="link link-dark" type="submit" style="text-decoration: none;" href='chooseRestaurantByDistance.php'>find more -></a>
      </div>
    </div>
    <div class="row m-3">
      <?php


      include "dbconn.php";
      // Check connection
      if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
      }
      if (isset($_COOKIE['lati'])) {
        $lat = $_COOKIE['lati'];
        $long = $_COOKIE['long'];
        $cood = $lat + $long;
      }
      $filtervalues = "";
      if (isset($_POST['search'])) {
        $filtervalues = $_POST['search'];
      }
      $sf = 3.14159 / 180; // scaling factor
      $sql = "SELECT * from add_rest order by ratingCount desc limit 4";
      $result = mysqli_query($conn, $sql);
      $count = 0; ?>
      <div class="row d-flex justify-content-center">
        <?php
        if (mysqli_num_rows($result) > 0) {
          // output data of each row
          while ($row = mysqli_fetch_assoc($result)) {

            $count++;
            if (isset($_COOKIE['lati'])) {
              $distance = abs(sqrt((pow(($row["lattitude"] - $lat), 2) + (pow(($row["longitude"] - $long), 2))))) / 0.0115165;
              if ($distance > 20) {
                continue;
              }
            }
        ?>
            <div class="col col-3 col-md-4 col-sm-4 text-left mx-xl-2 mx-md-5 my-3 " style="height: 200px; width:auto;">
              <a style="text-decoration: none;" href="myRestaurant.php?id=<?php echo $row['rest_id']; ?>">
                <div class="row" style="height: 140px; width:240px;">
                  <img src=" <?php echo $row["logo"] ?>" alt="error" height=100% style=" object-fit:cover; padding:0px;">
                </div>
                <h5 class="my-1 row"> <?php echo $row["rest_name"] ?></h5>
                <?php if (isset($_COOKIE['lati'])) {
                ?>
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
  </div>



  <!-- About Us -->
  <div class="container-fluid  text-center">



    <div class="row aboutUs text-center align-items-center">
      <div class="col col-2"></div>
      <div class="col col-md-8">

        <h3 class="text-black text-center  font-size-20">About Us</h3>
        <p class="text-white text-center  font-size-16">
          TatoTato is the fastest, easiest and most convenient way to enjoy the best food of your favourite restaurants
          at home, at the office or wherever you want to.
        </p>
        <p class="text-white text-center  font-size-16">
          We know that your time is valuable and sometimes every minute in the day counts.
          That's why we deliver! So you can spend more time doing the things you love.
        </p>
      </div>
      <div class="col col-2"></div>
    </div>
  </div>


  </div><!-- About Us -->

  <!-- Write message to add your company -->
  <?php
  if (isset($_SESSION["email"])) {
    $s_name = $_SESSION["first_name"] . " " . $_SESSION["last_name"];
    $s_email = $_SESSION["email"];
    $s_contactno = $_SESSION["phone"];




    if ($_SESSION["email"] == "admin@g.com") {
    
  ?>
    <div class="text-center my-3">
      <!-- <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#messageModal" data-bs-whatever="@getstrap">Add your restaurant</button> -->
      <a href="restaurantFullForm.php"><button class="btn btn-primary">Add Restaurant</button></a>
    </div>
  <?php
  }

  } else {
    $s_contactno = $s_email = $s_name = ""; ?>
    <button class="btn btn-primary" onclick="alertuser();">Add Your Restaurant</button>

  <?php } ?>

  <div class="modal fade" id="messageModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">New message</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form action="" method="post">
            <div class="mb-3">
              <label for="sender-name" class="col-form-label">Your Name:</label>
              <input type="text" class="form-control" id="sender-name" name="sender_name" value="<?php echo $s_name?>" required>
            </div>
            <div class="mb-3">
              <label for="restaurant-text" class="col-form-label">Restaurant's Name:</label>
              <input type="text" class="form-control" id="restaurant-text" name="restaurant_name" required>
            </div>
            <div class="mb-3">
              <label for="email" class="col-form-label">Email:</label>
              <input type="email" class="form-control" id="email" name="sender_email" value="<?php echo $s_email?>" required>
            </div>
            <div class="mb-3">
              <label for="contact-number" class="col-form-label">Contact Number:</label>
              <input type="Number" class="form-control" id="contact-number" name="sender_phone" value="$s_contactno" required>
            </div>
            <div class="mb-3">
              <label for="details" class="col-form-label">Details:</label>
              <textarea class="form-control" id="details" name="restaurant_details" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Send message</button>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary text-center" data-bs-dismiss="modal">Close</button>

        </div>
      </div>
    </div>
  </div>

  <!-- footer -->
  <?php require 'footer.php' ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script>
  <script>
    function alertuser() {
      alert("You need to log in first");
    }
  </script>
</body>

</html>

<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
echo "hello";
if (isset($_POST["submit"])) {

  $sender_name = $_POST["sender_name"];
  $restaurant_name = $_POST["restaurant_name"];
  $sender_email = $_POST["sender_email"];
  $sender_phone = $_POST["sender_phone"];
  $restaurant_details = $_POST["restaurant_details"];
  echo $restaurant_details;

  $conn = mysqli_connect("localhost", "root", "", "food_ordering_system");
  $sql4 = "SELECT * from add_rest where Email ='$sender_email'";
  $result = mysqli_query($conn, $sql4);
  if (mysqli_num_rows($result) > 0) {
?> <script>
      alert("You cannot use this email");
    </script> <?php
            }
            // elseif($_SESSION['role']!="rest_owner"){
            //   
            // <!-- <script>alert("You ") ; </script> -->

            // }
            else {
              // echo $conn;
              $query = "INSERT into `add_rest_message` (`Name`, `rest_name`, `email`,`phone`,`details`,`access`) values ('$sender_name','$restaurant_name','$sender_email' ,'$sender_phone','$restaurant_details',0)";
              echo $query;
              $result = mysqli_query($conn, $query);
            }
          }
              ?>