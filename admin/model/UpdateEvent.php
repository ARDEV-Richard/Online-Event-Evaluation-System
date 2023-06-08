<?php
include '../../config/config.php';
include '../controller/controller.php';
// Initialize the AddEvent class with the database connection
$UpdateEvent = new UpdateEvent($conn);
// Check if the form was submitted
if (isset($_POST["id"])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $start= $_POST['start'];
    $end= $_POST['end'];
    $result = $UpdateEvent->UpdateEvent($title, $start, $end,$id);
    if ($result) {
        // If successful, send a success message to the AJAX request
        echo json_encode(array("status" => "success", "message" => "Event updated successfully"));
        exit;
    } else {
        // If unsuccessful, send an error message to the AJAX request
        echo json_encode(array("status" => "error", "message" => "Failed to updated event"));
        exit;
    }
} 
?>
