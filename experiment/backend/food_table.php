<?php 
// $rest_id=$_GET["id"];
$conn=mysqli_connect('localhost','root', '', 'food_ordering_system');
$sql2 = "SELECT * from `food_ordering_system`.`add_rest` order by rest_id desc limit 1";
$result1 = mysqli_query($conn, $sql2);


$conn2 = mysqli_connect('localhost','root', '','food');
if (mysqli_num_rows($result1) > 0) {
	while ($row = mysqli_fetch_assoc($result1)) { 
		$ids= $row['rest_id'];
		// $sql1 = "CREATE TABLE `food`.`rest_$ids` ( `food_id` INT NOT NULL AUTO_INCREMENT , `food_name` VARCHAR(40) NOT NULL , PRIMARY KEY (`food_id`))";
		$sql1="CREATE TABLE `food`.`rest_$ids` ( `food_id` INT NOT NULL AUTO_INCREMENT , `food_name` VARCHAR(40) NOT NULL , `food_price` INT NOT NULL , `food_image` VARCHAR(40) NULL DEFAULT NULL , `food_category` VARCHAR(10) NOT NULL , PRIMARY KEY (`food_id`)) ENGINE = InnoDB;";
		$result = mysqli_query($conn2, $sql1);
		echo $sql1;
	}}  
    header("location: ../experiment.php");
?>