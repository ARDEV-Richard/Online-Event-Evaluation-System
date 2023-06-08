<?php
class FetchParticipantTable {
    private $conn;
    
    function __construct($conn) {
        $this->conn = $conn;
    }
    function FetchParticipantTable(){ 
    $sql= "SELECT *, CONCAT(first_name, ' ', last_name) AS full_name  FROM `users` WHERE Role='Participant' ORDER BY UserID DESC;";
    $result = mysqli_query($this->conn, $sql);
    return $result;
}
}

class EventReport {
    private $conn;
    
    function __construct($conn) {
        $this->conn = $conn;
    }
    function EventReport($EventID){ 
    $sql= "SELECT sr.`ResponseID`, sr.`ParticipantID`, sr.`event_id`, sr.`question_id`, sr.`response_text`,
    e.`EventID`, e.`title`, e.`start_event`, e.`end_event`, e.`created`,
    sq.`QuestionID`, sq.`event_id`, sq.`text`, sq.`type`, sq.`choice`,
    u.`UserID`, u.`first_name`, u.`last_name`, u.`email`, u.`phone`, u.`address`, u.`username`, u.`password`, u.`created`, u.`Role`
    FROM `survey_responses` sr
    JOIN `events` e ON sr.`event_id` = e.`EventID`
    JOIN `survey_questions` sq ON sr.`question_id` = sq.`QuestionID`
    JOIN `users` u ON sr.`ParticipantID` = u.`UserID`
    WHERE e.`EventID` = $EventID";
    $result = mysqli_query($this->conn, $sql);
    return $result;
}
}

?>
