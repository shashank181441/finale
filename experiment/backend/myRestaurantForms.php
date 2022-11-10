<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (isset($_POST["bt2"])) {
  $name = $_POST['newCat'];
  $id = $_POST['ids'];
  $conn = mysqli_connect('localhost', 'root', '', 'food');
  $sql1 = "INSERT INTO `categories` (`cat_id`, `cat_name`) VALUES ('$id', '$name')";
  $result = mysqli_query($conn, $sql1);
  header("location: ../myRestaurant.php?id=$id");
}


if (isset($_POST["bt3"])) {
  $name=$_POST["newFood"];
  $cate= $_POST["category"];
  $price=$_POST["foodPrice"];
  $rest_id = $_POST["rest_id"];
  $conn = mysqli_connect('localhost', 'root','', 'food');
  $sql2 ="INSERT INTO `rest_$rest_id` (`food_id`, `food_name`, `food_price`, `food_image`, `food_category`) VALUES (NULL, '$name', $price, NULL, '$cate')";
  $result = mysqli_query($conn, $sql2);
  echo $sql2;
  // echo $result1;
  header("location: ../myRestaurant.php?id=$rest_id");

}

if (isset($_POST["deleteFood"])) {
  unset($_POST["deleteFood"]);
  $food_id = $_POST["food_id"];
  $rest_id = $_POST["rest_id"];
  $conn = mysqli_connect('localhost', 'root','', 'food');
  $sql = "DELETE FROM `rest_$rest_id` WHERE `rest_$rest_id`.`food_id` = $food_id";
  $result = mysqli_query($conn, $sql);
  echo $sql;
  header("location: ../myRestaurant.php?id=$rest_id");

}


// <!-- } -->