<?php 
include '../config/config.php';
include '../controller/signup.php';

// Initialize the Login class with the database connection
$Check_User = new Check_User($conn);
$AddUser = new AddUser($conn);

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if student already exists in the database
    $student_exists = $Check_User->Check_User($first_name, $last_name, $email);
    if ($student_exists) {
        // Return error JSON response
        $response = array('success' => false, 'message' => 'Vendor already exists');
        header('Content-Type: application/json');
        echo json_encode($response);
    } else {
        // Add new student to the database
        $result = $AddUser->AddUser($first_name,$last_name,$username,$email,$password);
        if ($result) {
            // Return success JSON response
            $response = array('success' => true, 'message' => 'Vendor added successfully');
            header('Content-Type: application/json');
            echo json_encode($response);
        } else {
            // Return error JSON response
            $response = array('success' => false, 'message' => 'Error adding vendor');
            header('Content-Type: application/json');
            echo json_encode($response);
        }
    }
} else {
    // Return error JSON response if form was not submitted
    $response = array('success' => false, 'message' => 'Invalid request');
    header('Content-Type: application/json');
    echo json_encode($response);
}
?>
