<?php
class UserLogin {
  private $conn;

  function __construct($conn) {
    $this->conn = $conn;
  }

  function authenticate($username, $password) {
    $stmt = $this->conn->prepare("SELECT UserID, role FROM users WHERE username = ? AND password = ?");
    $stmt->bind_param("ss", $username, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $stmt->close();
    
    if ($result->num_rows == 1) {
      $row = $result->fetch_assoc();
      return $row; // return an associative array containing the user's ID and role
    } else {
      return false;
    }
  }
}
?>
