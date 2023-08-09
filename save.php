<?php
require 'conn.php';

if(isset($_POST['Save'])){

// save value in $var
$Right = $_POST['Right'];
$Left = $_POST['Left'];
$Forward = $_POST['Forward'];
$Backward = $_POST['Backward'];


$sql = "INSERT INTO dpath VALUES ('',$Right ,$Left ,$Forward, $Backward)";
mysqli_query($conn,$sql);
echo "<script>alert('Data Successfully Added in DataBase *-* '); window.location = 'SM23-Web2.php';</script>";



}

$conn->close();     // Close the database connection
?>