<?php 

// Connect to MySQL, select database
require ('../model/database.php');

// Check connection
if (mysqli_connect_errno($con)) {
    echo "Failed to connect to MySQL: " . mysqli_connect_error() . "<br>";
    exit("Connect Error");
} else
    echo 'Connected successfully' . '<br>';

if (isSet($_POST['action'])) {
    $action = $_POST['action'];
}
else if (isSet($_GET['action'])) {
    $action = $_GET['action'];
}
else {
    $action = 'show_techs';
}
//show technician
if ($action == 'show_techs') {
    $statement = "SELECT * FROM technicians;";
    $techs = mysqli_query($con, $statement) or die('show technician failed: '.mysqli_errno($con));
    include('show_techs.php');
}
// //delete technician
// else if ($action == 'delete_tech') {
//     $techID = $_POST['techID'];
//     TechnicianDB::delete_technician($techID);
//     header("Location: .?action=show_techs");
// }
// //add technician
// else if ($action == 'add_tech') {
//     $firstName = $_POST['firstName'];
//     $lastName = $_POST['lastName'];
//     $email = $_POST['email'];
//     $phone = $_POST['phone'];
//     $password = $_POST['password'];
//     if (empty($firstName) || empty($lastName) || empty($email) || 
//             empty($phone) || empty($password)) {
//         $error = "Please check that all fields are filled in correctly.";
//         include('../errors/error.php');
//     }
    else {
        $statement = "insert into technician Values($firstName, $lastName, $email,
                $phone, $password)";
        header("Location: .?action=show_techs");
        mysqli_query($con, $statement) or die('insert values failed: ' . mysqli_errno($con));
    }


