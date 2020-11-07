<!DOCTYPE html>
<html lang=en>
<head>
<meta charset= "utf-8">
<link href= 'partc.php' rel = 'stylesheet' type= 'text/css'>

</head>
<body>

<h1>Update Customer</h1>

<form action="partc.php" method= "get">
<table>
	<tr><td><label>First Name: </label></td><td><input type= "text" name = "first"  /></td></tr>
	<tr><td><label>Last Name: </label></td><td><input type= "text" name = "last"  /></td></tr>
	<tr><td><label>Address: </label></td><td><input type= "text" name = "address"  /></td></tr>
	<tr><td><label>City: </label></td><td><input type= "text" name = "city"  /></td></tr>
	<tr><td><label>State: </label></td><td><input type= "text" name = "state"  /></td></tr>
	<tr><td><label>Postal Code: </label></td><td><input type= "text" name = "postal"  /></td></tr>
	<tr><td><label>Country Code: </label></td><td><input type= "text" name = "country"  /></td></tr>
	<tr><td><label>Phone Number: </label></td><td><input type= "text" name = "phone"  /></td></tr>
	<tr><td><label>Email: </label></td><td><input type= "text" name = "email"  /></td></tr>
	<tr><td><label>Password: </label></td><td><input type= "text" name = "password"  /></td></tr>
	<tr><td><input type= "submit" value= "Update Customer"  /></td></tr>
</table>
</form>

<?php include('../view/header.php'); ?>
<?php
// Connect to MySQL, select database

if (mysqli_connect_errno( $connection)) {
    echo "Failed to connect to MySQL: " . mysqli_connect($connection);
    exit ("Connection Error");}
    ?>
    <?php include("../view/footer.php"); ?>
    
    
