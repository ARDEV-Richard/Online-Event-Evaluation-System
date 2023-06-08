<?php
session_start();
$errors = array(); // Initialize an array to hold any validation errors
include'../config/config.php';
include '../controller/signin.php';

$login = new UserLogin($conn);
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $role = '';
  $message = '';

  $response = $login->authenticate($username, $password);
if ($response) {
  $role = $response['role'];
  $user_id = $response['UserID'];
  $_SESSION['role'] = $role;
  $_SESSION['username'] = $username;
  $_SESSION['user_id'] = $user_id; // store the user's ID in the session
} else {
    if (empty($username) || empty($password)) {
      $message = 'Username and password are required.';
    } else {
      $message = 'Incorrect username or password.';
    }
  }

  echo json_encode(array('role' => $role, 'message' => $message));
  exit;
}

?>

