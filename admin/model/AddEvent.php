<?php
include '../../config/config.php';
include '../controller/controller.php';
// Initialize the AddEvent class with the database connection
$AddEvent = new AddEvent($conn);
// Check if the form was submitted
if (isset($_POST["title"])) {
    $title = $_POST['title'];
    $start= $_POST['start'];
    $end= $_POST['end'];
    $result = $AddEvent->AddEvent($title, $start, $end);
    if ($result) {
        // If successful, send a success message to the AJAX request
        echo json_encode(array("status" => "success", "message" => "Event added successfully"));
        exit;
    } else {
        // If unsuccessful, send an error message to the AJAX request
        echo json_encode(array("status" => "error", "message" => "Failed to add event"));
        exit;
    }
} 
?>
