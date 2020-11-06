<?php

// attempt login

// Turn off default error reporting
// error_reporting(0);

// allow MySQLi error reporting and Exception handling
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// use Exception Handling for empty form fields
if (!empty($_POST['product_code']) and !empty($_POST['name']) and !empty($_POST['version']) and !empty($_POST['release_date']) ) {
    $product_code = $_POST['product_code'];
    $name = $_POST['name'];
    $version = $_POST['version'];
    $release_date =  $_POST['release_date'];

    try {
        // Connect to MySQL, select database
        require ("../model/database.php");

        // test name and password for HTML characters to avoid HTML Injection
        require ("TestInput.php");
        $product_code = test_input($product_code);
        $name = test_input($name);
        $version = test_input($version);
        $release_date = test_input($release_date);

        // Prepare SQL query
        $query = mysqli_prepare($con, "INSERT INTO products (productCode, name, version, releaseDate) VALUES(?, ?, ?, ?);");
        mysqli_stmt_bind_param($query, "ssss",$product_code, $name,$version,$release_date  );
        mysqli_stmt_execute($query);
       
    } catch (Exception $e) {
        $message = $e->getMessage();
        $code = $e->getCode();
        header("Location: error.php?code=$code&message=$message");
    } finally{
        // close connection
        include 'index.php';
       
        mysqli_close($con);
    }
   
}// both fields not filled in, redirect to index.php
else
    header("Location: error.php?message='form fields not filled in'");
    include '../view/footer.php';
    
?>