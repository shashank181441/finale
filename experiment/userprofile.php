<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <?php 
     if(isset($_SESSION["email"])) {

    ?>
    <div class="container-fluid">
        <div class="row">
            <!-- <div class="col col-3"></div> -->
            <div class="col col-6">
            <table class="table">
        <tr>
            <td><img src="images/foodpick.jpg" alt="image" height="50px" width="50px"></td>
        </tr>
        <tr>
            <td class="border border-primary m-4"><?php echo $_SESSION['first_name']; ?></td>
            <td class="border border-primary m-4"><?php echo $_SESSION['last_name']; ?></td>
        </tr>
        <tr>
            <td class="border border-primary m-4"><?php echo $_SESSION['email']; ?></td>
            <td class="border border-primary m-4"><?php echo $_SESSION['phone']; ?></td>
        </tr>
    </table>
            
        </div></div>
    </div>

    <form action="logout.php" method="post"><button type="submit">log out</button></form>
    
     <?php }
     else{
        header("location:experiment.php");
      
     }
     
     ?>

   

    
</body>
</html>