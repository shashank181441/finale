<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
if ($_GET["submitMessage"]) {
    // $sender_name = $restaurant_name = $sender_email = $sender_phone = $restaurant_details = "";
    
    $sender_name = $_GET["sender_name"];
    $restaurant_name = $_GET["restaurant_name"];
    $sender_email = $_GET["sender_email"];
    $sender_phone = $_GET["sender_phone"];
    $restaurant_details = $_GET["restaurant_details"];
    echo $restaurant_details;

    $conn = mysqli_connect("localhost", "root", "", "food_ordering_system");
    echo $conn;
    $query = "INSERT into `add_rest_message` (`Name`, `rest_name`, `email`,`phone`,`details`,`id`) values ('$sender_name','$restaurant_name','$sender_email' ,'$sender_phone','$restaurant_details',`NULL`)";
    echo $query;
    $result = mysqli_query($conn, $query);
}

// }

?>