<?php
$id = $_GET['id'];
error_reporting(E_ERROR | E_PARSE);

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

?>

<!-- <script>
  function id() {
    let rest_id =
    document.getElementById("ids").value = rest_id;
    constole.log(rest_id);
  }
</script> -->

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>My Restaurant</title>
  <!-- <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <script type="text/javascript" src="js/bootstrap.bundle.min.js"></script> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.9.1/font/bootstrap-icons.css">

</head>

<body>
  <?php
  include "dbconn.php";
  include 'nav/nav.php';
  $conn2 = mysqli_connect("localhost", "root", "", "food");



  // Check connection
  if (!$conn2) {
    die("Connection failed: " . mysqli_connect_error());
  }

  $sql = "SELECT * FROM add_rest where rest_id = '$id'";

  $result = mysqli_query($conn, $sql);

  if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
      // print_r($row);
  ?>

      <!-- top bar pic -->
      <div class="container-fluid">
        <div class="row">
          <div class="col col-12" style="height: 60vh;">
            <img class="col-12" src="images/backgroundForAboutUs.jpg" alt="error" width="100%" height="100%" style="object-fit:cover;">
          </div>
          <!-- little details about locations wagera -->
          <div class="row">
            <div class="col col-1"></div>
            <div class="col col-6 text-left">
              <h1 class="text-left"><?php echo $row['rest_name'] ?></h1>

            </div>
          </div>
        </div>

        <h3 class="text mt-3">categories</h3>




        <!-- add a new category -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal3" data-bs-whatever="@getstrap">addCat</button>
        <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new categories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="" method="POST">
                  <div class="row">


                    <div class=" mb-3">
                      <label for="newCat" class="col-form-label">newCat:</label>
                      <input type="text" class="form-control" id="newCat" name="newCat" required>
                    </div>
                    <!-- <input type="text" name="ids" id="ids"> -->

                    <button type="submit" class="btn btn-primary mb-3" name="bt2">Add</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <?php

        if (isset($_POST["newCat"])) {
          $name = $_POST['newCat'];
          // $id = $_POST['ids'];

          $sql = "INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES ('$id', '$name')";

          $result = mysqli_query($conn2, $sql);
          header("location:myRestaurantForms.php");
        }
        ?>



        <!-- Add a few food -->
        <button style="width:200px;" type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal4" data-bs-whatever="@getstrap">add Food</button>
        <div class="modal fade" id="exampleModal4" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add new categories</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="backend/myRestaurantForms.php" method="POST">
                  <div class="row">


                    <div class=" mb-3">
                      <select name="category" id="category">
                        <?php

                        $sqlForSelect = "SELECT * from categories where cat_id = $id ";
                        $resultForSelect = mysqli_query($conn2, $sqlForSelect);


                        if (mysqli_num_rows($resultForSelect) > 0) {
                          while ($row = mysqli_fetch_assoc($resultForSelect)) {

                        ?><option value="<?php echo $row['cat_name']; ?>">
                              <?php echo $row['cat_name']; ?></option>
                        <?php
                          }
                        } else {
                          echo "No food items";
                        }
                        ?>
                      </select>
                      <label for="newCat" class="col-form-label">Food name:</label>
                      <input type="text" class="form-control" id="newFood" name="newFood" required>
                    </div>
                    <div class=" mb-3">
                      <label for="newCat" class="col-form-label">Price:</label>
                      <input type="number" class="form-control" id="foodPrice" name="foodPrice" required>
                    </div>
                    <!-- <div class=" mb-3">
                      <label for="newCat" class="col-form-label">Image:</label>
                      <input type="file" class="form-control" id="images" name="images" required>
                    </div> -->
                    <input type="text" name="rest_id" value=<?php echo $id ?>>

                    <!-- <input type="text" name="ids" id="ids"> -->

                    <button type="submit" class="btn btn-primary mb-3" name="bt3">Add</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <?php


        if (isset($_POST["newFood"])) {
          $name = $_POST['newFood'];
          $price = $_POST['foodPrice'];
          $image = $_POST['images'];
          $category = $_POST['category'];
          // $id = $_POST['ids'];


          $conn2 = mysqli_connect('localhost', 'root', '', 'food');
          $sql = "INSERT INTO `rest_$id` (`food_name`, `food_price`,`food_image`,`food_category`) VALUES ( '$name','$price','$image','$category')";
          $result = mysqli_query($conn2, $sql);
          // header("location:myRestaurantForms.php");
        }

        ?>

        <!-- Food order table -->
        <div class="row m-3">
          <div class="col col-1"></div>
          <div class="col col-10">
            <table class="table col col-10">
              <?php

              // $conn2 = mysqli_connect("localhost", "root", "", "food");

              $sql = "SELECT * from rest_$id order by food_category";
              // echo $sql; 
              $result = mysqli_query($conn2, $sql);
              $cat = "";

              if (mysqli_num_rows($result) > 0) {
                // output data of each row
                while ($row = mysqli_fetch_assoc($result)) {
                  if ($row['food_category'] != $cat) {

              ?>
                    <thead class="thead-dark" id="table_start">
                      <tr class=" table-warning">
                        <th scope="col">
                          <?php echo $row['food_category'];
                          $cat = $row["food_category"]; ?></th>
                        <td></td>
                      </tr>
                    </thead><?php
                          } ?>
                  <tbody>
                    <tr>
                      <th scope="row"><?php echo $row['food_name']; ?></th>
                      <td class="col">
                        <div class="d-flex justify-content-end">
                          <?php echo $row['food_price'] ."    ";?>
                          <form action="" method="post">
                            <div>
                              <input type="text" name="food_name" value="<?php echo $row['food_name'] ?>" hidden>
                              <input type="text" name="food_price" value="<?php echo $row['food_price'] ?>" hidden>
                              <input type="text" name="food_id" value="<?php echo $row['food_id'] ?>" hidden>
                              <input type="text" name="id" value="<?php echo $id ?>" hidden>
                            </div>
                            <?php
                            if (isset($_SESSION["email"])) {
                              if (isset($_SESSION["payment"])) {
                                unset($_SESSION["payment"]);
                              }
                            ?>
                              <button class="btn btn-primary m-2 col" name="addCart" type="submit">+</button>
                            <?php } else { ?>
                              <button class="btn btn-primary m-2 col" id="bt5" onclick="alerting()">+</button>
                            <?php } ?>
                            </form>

                            <form action="backend/myRestaurantForms.php" method="post">
                              <input type="number" name="food_id" value="<?php echo $row['food_id']?>"hidden>
                              <input type="number" name="rest_id" value="<?php echo $id ?>" hidden>
                              <button class="btn btn-light" type="submit" name="deleteFood" onclick="confirmIt()"><i class="bi bi-trash"></i></button>
                            </form>
                            <script>
                              function confirmIt() {
                                confirm(' you sure to deleteFood');
                              }
                              
                            </script>

                            <!-- <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#edit" data-bs-whatever="@getstrap">:</button>
  

                            <div class="modal fade" id="edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="POST">
          <div class="row">
            <div class=" mb-3">
              <label for="email" class="col-form-label">food Name:</label>
              <input type="text" class="form-control" id="food_name" name="food_name" required>
            </div>
            <p>
              <input type="number" name="price" placeholder="price">
            </p>
            <button type="submit" class="btn btn-light mb-3" name="editButton">Submit</button>
            </div>
        </form>
      </div>
    </div>
  </div>
</div> -->


                          
                        </div>
                      </td><?php

                            if (isset($_POST["addCart"])) {
                              if (isset($_SESSION["email"])) {
                                $food_name = $_POST['food_name'];
                                $food_price = $_POST['food_price'];
                                $food_id = $_POST['food_id'];
                                $id = $_POST['id'];
                                $products = array('food_name' => $food_name, 'food_price' => $food_price, 'food_id' => $food_id, 'id' => $id);
                                $_SESSION['products'][$food_name] = $products;
                            ?>
                          <script>
                            window.location.replace("myRestaurant.php?id=".<?php echo $id ?>."#table_start");
                          </script><?php
                                    // <!-- // header("location:myRestaurant.php?id=".$id."#table_start"); -->
                                  }
                                }
                              }
                            } else {
                              echo "no items available";
                            }

                                    ?>
                  <a href="tests/myCart.php" class="position-absolute top-10 start-0 mt-6"><button class="btn btn-light"><i class="bi bi-cart"></i></button></a>

                    </tr>

                  </tbody>
            </table>
          </div>


      <?php
    }
  }
  require 'footer.php'; ?>

      <script>
        function alerting() {
          alert("Please Log In");
        }
        // alerting();
      </script>


</body>

</html>