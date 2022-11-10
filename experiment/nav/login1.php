<?php
if(isset($_POST["bt1"]))
{



      include "dbconn.php";
      $email=$_POST["email1"];
      $password=$_POST["pass"];
      
      

          
      $email_search="select * from registration where Email='$email'";

      $query1=mysqli_query($conn, $email_search);

      $email_count=mysqli_num_rows($query1);
      
    if($email_count)//valid email
    {
        
          $email_pass=mysqli_fetch_assoc($query1);
          $db_pass=$email_pass["Password"];
          $_SESSION['email']=$email_pass['Email'];
          $_SESSION['first_name']=$email_pass['FirstName'];
          $_SESSION['last_name']=$email_pass['LastName'];
          $_SESSION['phone']=$email_pass['ContactNumber'];

          

          $pass_decode=password_verify($password, $db_pass);
          echo "<script>alert('hello');</script>";
          echo "<script>alert($db_pass);</script>";
       if($pass_decode)
       {
          echo "<script>alert('login successful');</script>";
            
        
             }
       else
       {
        
        echo "<script>alert('password incorrect  you know what isay');</script>";
              
           
       }
    }
    else //invalid email
    {

      echo "<script>alert('email incorrect');</script>";

    }
      
}


  



?>