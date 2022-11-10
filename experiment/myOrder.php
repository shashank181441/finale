<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MyOrder</title>
</head>
<body>
    <?php 
    include "nav/nav.php";
    include "dbconn.php";


    $conn2 = mysqli_connect("localhost", "root", "", "food");
    $email= $_SESSION['email'];

    $sql = "SELECT * from orders where `customerEmail` = `$email`";
    $result = mysqli_query($conn2,$sql);

    if (mysqli_num_rows($result) > 0) {
        // output data of each row
        while ($row = mysqli_fetch_assoc($result)) {
            echo $row["FoodId"];

        }}
    
    
    ?>
</body>
</html>