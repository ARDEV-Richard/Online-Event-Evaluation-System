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


$questions = array();
$sql = "SELECT QuestionID, text, type, choice FROM survey_questions WHERE event_id = 1";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $question = array(
            'id' => $row['QuestionID'],
            'text' => $row['text'],
            'type' => $row['type'],
            'choices' => explode(',', $row['choice'])
        );
        $questions[] = $question;
    }
}
?>