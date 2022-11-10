<?php $conn2 = mysqli_connect("localhost","root", "","food");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);?>

<?php
header("Location:myCart.php");
?>