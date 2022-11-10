<?php

session_start();
$_SESSION["payment"]=1;

header("location:../tests/myCart.php");
?>
<!-- <script type="text/javascript">
    windows.location.replace("../tests/myCart.php");
</script> -->