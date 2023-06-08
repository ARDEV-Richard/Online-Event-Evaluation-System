
<?php 
session_start();
class AddEvent {
    private $conn;
    
    function __construct($conn) {
        $this->conn = $conn;
    }
    function AddEvent($title, $start,$end){
        $sql = "INSERT INTO `events`(`title`, `start_event`, `end_event`) VALUES ('$title','$start','$end')";
        $result = mysqli_query($this->conn, $sql);
        $this->conn->close();
        return $result;
    }
}
class Event {
    public $id;
    public $title;
    public $start;
    public $end;
}
class EventRepository {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function getAllEvents() {
        $data = array();
        $query = "SELECT * FROM events ORDER BY EventID";
        $result = mysqli_query($this->conn, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $event = new Event();
            $event->id = $row["EventID"];
            $event->title = $row["title"];
            $event->start = $row["start_event"];
            $event->end = $row["end_event"];

            $data[] = $event;
        }

        $this->conn->close();
        return $data;
    }
}
class UpdateEvent {
    private $conn;
    
    function __construct($conn) {
        $this->conn = $conn;
    }
    function UpdateEvent($title, $start,$end,$EventID){
        $sql = "UPDATE `events` SET `title`='$title',`start_event`='$start',`end_event`='$end' WHERE `EventID`='$EventID'";
        $result = mysqli_query($this->conn, $sql);
        $this->conn->close();
        return $result;
    }
}

class DeleteEvent {
    private $conn;
    
    function __construct($conn) {
        $this->conn = $conn;
    }
    function DeleteEvent($EventID){
        $sql = "DELETE FROM `events` WHERE `EventID`='$EventID'";
        $result = mysqli_query($this->conn, $sql);
        $this->conn->close();
        return $result;
    }
}

class InsertSurveyQuestions {
    private $conn;

    function __construct($conn) {
        $this->conn = $conn;
    }

    function insertQuestions($EventListID,$questions, $questionnaireTypes, $multipleChoices) {
        // Loop through each question and questionnaire type
        for ($i = 0; $i < count($questions); $i++) {
            $question = mysqli_real_escape_string($this->conn, $questions[$i]);
            $questionnaireType = mysqli_real_escape_string($this->conn, $questionnaireTypes[$i]);
            $choices = "";

            // Loop through each choice in the multipleChoices array and concatenate them into a string
            foreach ($multipleChoices[$i] as $choice) {
                $choices .= mysqli_real_escape_string($this->conn, $choice) . ",";
            }

            // Remove the trailing comma from the choices string
            $choices = rtrim($choices, ",");

            $sql = "INSERT INTO survey_questions (event_id,text, type, choice) 
                    VALUES ('$EventListID','$question', '$questionnaireType', '$choices')";
            mysqli_query($this->conn, $sql);
        }

        // Close the database connection
        $this->conn->close();
    }
 }
// class FetchEventList {
//     private $conn;
  
//     function __construct($conn) {
//       $this->conn = $conn;
//     }
  
//     function FetchEventList() {
//       $sql = "SELECT * FROM events";
//       $result = $this->conn->query($sql);
//       $events = array();
//       if($result->num_rows > 0) {
//         while($row = $result->fetch_assoc()) {
//           $events[] = $row;
//         }
//       }
//       return $events;
//     }
  
//     function SearchEvents($searchTerm) {
//       $sql = "SELECT * FROM events WHERE title LIKE '%" . $searchTerm . "%'";
//       $result = $this->conn->query($sql);
//       $events = array();
//       if($result->num_rows > 0) {
//         while($row = $result->fetch_assoc()) {
//           $events[] = $row;
//         }
//       }
//       return $events;
//     }
//   }

  class FetchEventList {
    private $conn;

    function __construct($conn) {
        $this->conn = $conn;
    }

    function FetchEventList() {
        $sql = "SELECT * FROM events ORDER BY created DESC";
        $result = $this->conn->query($sql);
        $events = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $events[] = $row;
            }
        }
        return $events;
    }

    function SearchEvents($searchTerm) {
        $sql = "SELECT * FROM events WHERE title LIKE '%" . $searchTerm . "%' ORDER BY created DESC";
        $result = $this->conn->query($sql);
        $events = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $events[] = $row;
            }
        }
        return $events;
    }
}


  
  class SurveyQuestions {
    private $conn;
    
    function __construct($conn) {
        $this->conn = $conn;
    }
    
    function getQuestions($eventId) {
        $questions = array();
        $sql = "SELECT QuestionID, text, type, choice FROM survey_questions WHERE event_id = $eventId";
        $result = $this->conn->query($sql);
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
        return $questions;
    }
}


class DeleteParticipation {
    private $conn;
    
    function __construct($conn) {
        $this->conn = $conn;
    }
    function DeleteParticipation($UserID){
        $sql = "DELETE FROM `users` WHERE `UserID`='$UserID'";
        $result = mysqli_query($this->conn, $sql);
        $this->conn->close();
        return $result;
    }
}


  class eventlist {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    public function eventlist() {
        $sql = "SELECT * FROM `events`";
        $result = mysqli_query($this->conn, $sql);
        $this->conn->close();
        return $result;
    }
}


?>
