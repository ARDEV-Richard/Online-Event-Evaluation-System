<?php
include '../../config/config.php';
include '../controller/controller.php';
// Initialize the AddEvent class with the database connection
$DeleteEvent = new DeleteEvent($conn);
// Check if the form was submitted
if (isset($_POST["id"])) {
    $id = $_POST['id'];
    $result = $DeleteEvent->DeleteEvent($id);
    if ($result) {
        // If successful, send a success message to the AJAX request
        echo json_encode(array("status" => "success", "message" => "Event deleted successfully"));
        exit;
    } else {
        // If unsuccessful, send an error message to the AJAX request
        echo json_encode(array("status" => "error", "message" => "Failed to add event"));
        exit;
    }
} 
?>
