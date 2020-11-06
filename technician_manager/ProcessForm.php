<?php

// attempt login

// Turn off default error reporting
// error_reporting(0);

// allow MySQLi error reporting and Exception handling
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// use Exception Handling for empty form fields
if (!empty($_POST['firstName']) and !empty($_POST['lastName']) and !empty($_POST['email']) and !empty($_POST['phone']) and !empty($_POST['password']) ) {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];

    try {
        // Connect to MySQL, select database
        require ("../model/database.php");

        // test name and password for HTML characters to avoid HTML Injection
        require ("TestInput.php");
        $firstName = test_input($firstName);
        $lastName = test_input($lastName);
        $email = test_input($email);
        $phone = test_input($phone);
        $password = test_input($password);

        // Prepare SQL query
        $query = mysqli_prepare($con, "INSERT INTO technicians (firstName, lastName, email, phone, password) VALUES(?, ?, ?, ?, ?);");
        mysqli_stmt_bind_param($query, "sssss",$firstName, $lastName, $email, $phone, $password  );
        mysqli_stmt_execute($query);
       
    } catch (Exception $e) {
        $message = $e->getMessage();
        $code = $e->getCode();
        header("Location: error.php?code=$code&message=$message");
    } finally{
        // close connection
        mysqli_close($con);
        header("Location: .?action=show_techs");
        include('index.php');
    }
    
}// both fields not filled in, redirect to index.php
else
    header("Location: error.php?message='form fields not filled in'");
    include '../view/footer.php';
    
?>