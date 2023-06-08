<?php
include '../../config/config.php';
include '../controller/controller.php';

// Initialize the FetchEventList class with the database connection
$fetchEventList = new FetchEventList($conn);

// Call the getEvents function to retrieve all events from the database
$events = $fetchEventList->FetchEventList();

// Display the events as a list
$html = '<ul class="list-group list-group-flush">';
foreach($events as $event) {
    $html .= '<li class="list-group-item">' . $event['title'] . '</li>';
    $start = new DateTime($event['start_event']);
    $end = new DateTime($event['end_event']);
    $html .= '<li class="list-group-item">' . $start->format('D, M j, Y g:i A') . ' - ' . $end->format('D, M j, Y g:i A') . '</li>';        
    // You can add more fields here as needed

    // Add two buttons: one for reviewing and one for submitting the questionnaire
    $html .= '<li class="list-group-item">';
    $html .= '<a href="EvaluationQuestion.php?EventListID='.$event['EventID'].'" class="btn btn-primary btn mb-2 text-white" data-id="'.$event['EventID'].'">Submit Questionnaire</a>';
    $html .= '<a href="ReviewEvaluationForm.php?EventListID='.$event['EventID'].'" class="btn btn-success btn mb-2 btn-light" data-id="'.$event['EventID'].'">Review </a>';
    $html .= '</li>';
}
$html .= '</ul>';

echo $html;

?>
