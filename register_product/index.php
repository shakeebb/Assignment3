<?php
require ('../model/database.php');
session_start();

if (isSet($_POST['action'])) {
    $action = $_POST['action'];
}
else if (isSet($_GET['action'])) {
    $action = $_GET['action'];
}
else if(isSet($_SESSION['email'])) {
    $action = 'verify_email';
}
else {
    $action = 'login';
}

switch($action) {
    case 'login':
        include('login.php');
        break;
    case 'verify_email':
        if(!isSet($_SESSION['email'])) {
            $_SESSION['email'] = $_POST['email'];
        }
        $statement = "SELECT * FROM customers where email =". "\"". $_SESSION['email']. "\";";
        $customers = mysqli_query($con, $statement) or die('get customers failed: '.mysqli_errno($con));
        $statement = "SELECT * FROM products";
        $result = mysqli_query($con, $statement) or die('get customers failed: '.mysqli_errno($con));
        $products = mysqli_fetch_array($result, MYSQLI_ASSOC);
        include('register_product.php');
        break;
    case 'register_product':
        if(!isSet($_SESSION['customerID'])) {
            $_SESSION['customerID'] = $_POST['customerID'];
            
        }
        $productcon = $_POST['productName'];
        $sqlCode = "SELECT productCode from products WHERE name ='" . $productcon. "';" ;
        $productcode = mysqli_query($con, $sqlCode);
        $productcode = mysqli_fetch_array($productcode)[0];
        
        $date = date('Y-m-d');
        $statement = "INSERT INTO registrations (customerID,productCode, registrationDate )VALUES('" .$_SESSION['customerID']."','" . $productcode."'," . "NOW())";
        $run = mysqli_query($con, $statement);
      
        include('registration_confirmation.php');
        break;
        
}

/*if ($action == 'login') {
    include('login.php');
}
else if ($action == 'verify_email') {
    $email = $_POST['email'];
    $customers = search_by_email($email);
    $products = get_products();
    include('register_product.php');
}
else if ($action == 'register_product') {
    $customerID = $_POST['customerID'];
    $product_code = $_POST['productCode'];
    $date = date('Y-m-d');
    add_registration($customerID, $product_code, $date);
    include('registration_confirmation.php');
}*/

