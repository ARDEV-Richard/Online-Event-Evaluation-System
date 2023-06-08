
<?php 
session_start();


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
class FetchEventList {
    private $conn;
  
    function __construct($conn) {
      $this->conn = $conn;
    }
  
    function FetchEventList() {
      $sql = "SELECT * FROM events";
      $result = $this->conn->query($sql);
      $events = array();
      if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
          $events[] = $row;
        }
      }
      return $events;
    }
  
    function SearchEvents($searchTerm) {
      $sql = "SELECT * FROM events WHERE title LIKE '%" . $searchTerm . "%'";
      $result = $this->conn->query($sql);
      $events = array();
      if($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
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


class SubmitAnswerQuestion{
    private $conn;
    
    function __construct($conn) {
        $this->conn = $conn;
    }
    function SubmitAnswerQuestion($ParticipantID,$EventID,$QuestionID,$ResponseAnswerQuestion){
        $sql = "INSERT INTO survey_responses (ParticipantID,event_id, question_id, response_text) VALUES ($ParticipantID,$EventID,$QuestionID, '$ResponseAnswerQuestion')";
        $result = mysqli_query($this->conn, $sql);
        return $result;
    }
}
class SurveyResponses {
  private $conn;

  function __construct($conn) {
      $this->conn = $conn;
  }

  function getResponses($participant_id) {
      $sql = "SELECT question_id, response_text FROM survey_responses WHERE ParticipantID = $participant_id";
      $result = $this->conn->query($sql);
      $responses = array();
      if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
              $responses[$row['question_id']] = $row['response_text'];
          }
      }
      return $responses;
  }
}

?>
