<?php 
class Check_User {
    private $conn;
    
    function __construct($conn) {
        $this->conn = $conn;
    }
function Check_User($first_name,$last_name,$email){ 
    $sql= "SELECT `first_name`,`last_name` ,`email`  FROM `users` WHERE `first_name`='$first_name' AND `last_name`='$last_name' AND `email`='$email'";
    $result=mysqli_query($this->conn,$sql);
    $count=mysqli_num_rows($result);
    return $count;
   }
}
class AddUser {
    private $conn;

    function __construct($conn) {
        $this->conn = $conn;
    }
    function AddUser($first_name,$last_name,$username,$email,$password){
    $sql = "INSERT INTO users (first_name, last_name, username, email, password,role) VALUES ('$first_name', '$last_name', '$username', '$email', '$password','participant')";
    $result = mysqli_query($this->conn, $sql);
    $this->conn->close();
    return $result;
    }
}
?> 