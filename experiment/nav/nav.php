<?php
session_start();


?>

<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<script src="js/bootstrap.bundle.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    


<nav class="navbar navbar-expand-md navbar-white fixed-top bg-white py-0">
  <div class="container-fluid">
    <ul class="navbar-nav me-auto ">
      <li class="nav-item ">
        <a class="nav-link active" href="experiment.php"><img src="images/tatotato.png" width="100px" alt=""></a>
      </li>
    </ul>
    <?php
    if (isset($_SESSION['email'])) {
    ?>
      
  

      <a href="userprofile.php"><button type="button" class="btn btn-outline-primary mx-3">users</button></a>
      <a class="link link-secondary" href="messages.php?email=<?php echo $_SESSION['email']; ?>"><button class="btn btn-warning mx-3">Messages</button></a>
  </div>
</nav>
<?php


    } else {
?>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-whatever="@getstrap">LogIns</button>
  </div>
  </nav><?php
      }

        ?>

<div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
              <label for="email" class="col-form-label">Email:</label>
              <input type="email" class="form-control" id="email" name="email1" required>
            </div>

            <div class="cmb-3 mb-3">
              <label for="first-name" class="col-form-label">Enter password:</label>
              <input type="password" class="form-control" id="password" name="pass" required>
            </div>


            <button type="submit" class="btn btn-primary mb-3" name="bt1">Log In</button>
            <p>If you don't have any account, <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@getbootstrap">Sign up</a></p>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php
if (isset($_POST["bt1"])) {

  include "dbconn.php";
  $email = $_POST["email1"];
  $password = $_POST["pass"];

  $email_search = "select * from registration where Email='$email'";

  $query1 = mysqli_query($conn, $email_search);

  $email_count = mysqli_num_rows($query1);

  if ($email_count) //valid email
  {
    $email_pass = mysqli_fetch_assoc($query1);
    $db_pass = $email_pass["Password"];




    $pass_decode = password_verify($password, $db_pass);

    if ($pass_decode) {
      // session_start();
      $_SESSION['email'] = $email_pass['Email'];
      $_SESSION['first_name'] = $email_pass['FirstName'];
      $_SESSION['last_name'] = $email_pass['LastName'];
      $_SESSION['phone'] = $email_pass['ContactNumber'];
      $_SESSION["password"] = $email_pass["Password"];
      $_SESSION["role"] = $email_pass["role"];
    } else {

      echo "<script>alert('password incorrect  you know what isay');</script>";
    }
  } else //invalid email
  {

    echo "<script>alert('email incorrect');</script>";
  }
  header("Location:experiment.php");
}
?>
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel3" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">New message</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="" method="post">
          <div class="row">
            <div class="col col-md-6 mb-3">
              <label for="first-name" class="col-form-label">First Name:</label>
              <input type="text" class="form-control" id="first-name" name="firstname" required>
            </div>
            <div class="col col-md-6 mb-3">
              <label for="second-name" class="col-form-label">Last Name:</label>
              <input type="text" class="form-control" id="second-name" name="lastname" required>
            </div>

            <div class="col col-md-6 mb-3">
              <label for="email" class="col-form-label">Email:</label>
              <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="col col-md-6 mb-3">
              <label for="contact-number" class="col-form-label">Contact Number:</label>
              <input type="text" class="form-control" id="contact-number" name="contactno" required></input>
            </div>
            <div class="col col-md-6 mb-3">
              <label for="first-name" class="col-form-label">Enter password:</label>
              <input type="password" class="form-control" id="password" name='password' required>
            </div>
            <div class="col col-md-6 mb-3">
              <label for="first-name" class="col-form-label">Confirm password:</label>
              <input type="password" class="form-control" id="confirm_password" name="repeatwalapassword" required>
            </div>
            <select class="form-select" name="role" aria-label="Default select example">
              <option selected>Role</option>
              <option value="delivery">Delivery</option>
              <option value="customer">Customer</option>
              <option value="rest_owner">Restaurant Owner</option>
            </select>

            <button type="submit" class="btn btn-primary" name="submits">Sign Up</button>

          </div>
        </form>
        <p>If you already have an account, <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#exampleModal2" data-bs-whatever="@getbootstrap">log In</button> </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary text-center" data-bs-dismiss="modal">Close</button>

      </div>
    </div>
  </div>
</div>

<?php




if (isset($_POST["submits"])) {
  include "dbconn.php";
  $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
  $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $contactno = mysqli_real_escape_string($conn, $_POST['contactno']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $repeatpassword = mysqli_real_escape_string($conn, $_POST['repeatwalapassword']);
  $role = mysqli_real_escape_string($conn, $_POST['role']);

  $pass = password_hash($password, PASSWORD_BCRYPT);
  $cpassword = password_hash($repeatpassword, PASSWORD_BCRYPT);




  $emailquery = "select * from registration where Email='$email'";

  $query = mysqli_query($conn, $emailquery);

  $emailcount = mysqli_num_rows($query);




  if ($emailcount > 0) {


    echo "<script>alert('email already exist')<script>";
  } else {



    if ($password === $repeatpassword) {


      $insertquery = "INSERT INTO registration(FirstName,LastName,Email,ContactNumber,Password,RepeatPassword,role) VALUES ('$firstname','$lastname','$email','$contactno','$pass','$cpassword','$role')";
      $iquery = mysqli_query($conn, $insertquery);



      if ($iquery) {

        // echo "<script>alert('data are inserted')</script>";

      } else {

        // echo "<script>alert('data are not inserted')</script>";
      }
    } else {

      echo "<script>alert('password is not match')</script>";
    }
  }
}
?>
<div style="width: auto;height:80px;"></div>