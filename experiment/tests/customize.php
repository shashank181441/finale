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
</head>

<body>

  <?php
  ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
  include "../dbconn.php";
  if (!isset($_SESSION['$cartItems'])) {
    echo "No items";
  }
  ?>
  <div class="row m-3">
    <div class="col col-2"></div>
    <div class="col col-6">
      <table class="table col col-6">
        <?php
        $total = 0;
        $count = 0;
        foreach ($_SESSION["products"] as $products) {
          $prevID = $products['id'];
          break;
        }


        foreach ($_SESSION["products"] as $products) {
          $count+=1;

          // echo "hello";
          if ($products['id'] != $prevID) {
            echo "You have added items from two restaurants";
          }
        ?>
          <tbody>
            <tr>
              <th scope="row"><?php echo $products['food_name']; ?></th>
              <td>
                <form action="customOrder.php" method="post">
                    <h5><?php echo $products['food_price']?></h5>
                <input name="food_name" value = "<?php echo $products['food_price'];?>" hidden>
                
                <h5> <?php $total += $products['food_price']; ?></h5>
              </td>
              <td><textarea type="textarea" placeholder="your specifications" style="width:400px;"></textarea></td>
            </form>
            </tr>
          </tbody><?php
                  $prevID = $products['id']; ?>
                  
          <?php } 
          echo "total = " . $total;
          echo "no. of items=" . $count."<br>";
          ?><form action="../backend/orderNow.php" method="post">
          <button type="submit" name="placeOrder" class="btn btn-primary">order Now</button>
          </form>
          <a href="customize.php" class="link link-secondary"><button>Customize</button></a>

      </table>
    </div>
    <?php
    
    ?>
</body>

</html>
<?php

// print_r($_SESSION["products"]);
// session_destroy();
?>
<a href="tables.php">tables</a>