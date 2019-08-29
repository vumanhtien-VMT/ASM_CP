<?php
require("connect.php");
$id = $_POST['productid'];
$sql = "DELETE FROM product WHERE productid = '$id'";
pg_query($conn,$sql); 
header("Location: /managing.php");
?>
