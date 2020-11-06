<?php

//index for product manager 
require('../model/database.php');

// Check connection
if (mysqli_connect_errno($con)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
    exit("Connect Error");
} else
    echo 'Connected successfully' . '<br>';

    
if (! empty($_POST['productCode'])) {
    $productCode = $_POST['productCode'];
    $query = "DELETE FROM products WHERE productCode='$productCode';";
    $result = mysqli_query($con, $query);
} // end if
$statement = "SELECT * FROM products;";
$products = mysqli_query($con, $statement) or die('show products failed: '.mysqli_errno($con));

include('show_products.php');



?>