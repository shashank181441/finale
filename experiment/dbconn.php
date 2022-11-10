<?php

$server="localhost";
$user="root";
$password="";
$databasename="food_ordering_system";

$conn=mysqli_connect($server,$user,$password,$databasename);
// $conn2 = mysqli_connect('localhost', 'root', '', 'food');

 if($conn){
     ?>

<!-- <script>
    alert("connection successful");
</script> -->

<?php
 }else{
   ?>
   <script>
      alert("no connection");
    </script>
<?php

 }
      
?>