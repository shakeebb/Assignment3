<?php 

//index for tech manager
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
// else if (isSet($_GET['action'])) {
//     $action = $_GET['action'];
// }

else {
    $action = 'show_techs';
}
//show technician
if ($action == 'show_techs' || $action =='ProcessForm.php') {
    $statement = "SELECT * FROM technicians;";
    $techs = mysqli_query($con, $statement) or die('show technician failed: '.mysqli_errno($con));
    include('show_techs.php');
}
//delete technician
else if ($action == 'delete_tech') {
    $techID = $_POST['techID'];
    $query = "DELETE FROM technicians WHERE techID='$techID';";
    $result = mysqli_query($con, $query);
    header("Location: .?action=show_techs");
}

?>