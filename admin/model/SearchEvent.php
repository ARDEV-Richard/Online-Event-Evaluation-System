<?php
     // In your PHP code (SearchEvent.php)
include '../../config/config.php';
include '../controller/controller.php';

// Initialize the FetchEventList class with the database connection
$fetchEventList = new FetchEventList($conn);

// Check if a search term was submitted
if(isset($_GET['q'])) {
  $searchTerm = $_GET['q'];
  $events = $fetchEventList->SearchEvents($searchTerm);
} else {
  // Call the getEvents function to retrieve all events from the database
  $events = $fetchEventList->FetchEventList();
}

// Display the events as a list
$html = '<ul class="list-group list-group-flush">';
foreach($events as $event) {
  $html .= '<li class="list-group-item">' . $event['title'] . '</li>';
  $start = new DateTime($event['start_event']);
  $end = new DateTime($event['end_event']);
  $html .= '<li class="list-group-item">' . $start->format('D, M j, Y g:i A') . ' - ' . $end->format('D, M j, Y g:i A') . '</li>';        
  // You can add more fields here as needed
  $html .= '<a href="EvaluationForm.php?EventListID='.$event['EventID'].'&title='.urlencode($event['title']).'" class="event-link btn btn-primary" data-id="'.$event['EventID'].'">Open Evaluation Form</a>';
}
$html .= '</ul>';
echo $html;

    ?>



