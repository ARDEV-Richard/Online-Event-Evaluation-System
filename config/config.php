<?php  
$host ="localhost";
$user ="root";
$pass="";
$db ="evaluating_db";
$conn = mysqli_connect($host,$user,$pass,$db);
mysqli_set_charset($conn,"utf8");
// Check connectione
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
} 
?>
