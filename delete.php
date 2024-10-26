<?php
include 'inc/header.php';   
include 'dbConnection.php';

if (isset($_GET['id'])) {
   $id = $_GET['id'];

$del="DELETE FROM `product` WHERE `ID`='$id'";

$rundel=mysqli_query($conn,$del);

if ($rundel) {
   echo "Product deleted successfully.";
} else {
   echo "Error deleting product: " ;
}
header('location:index.php');
}

?>