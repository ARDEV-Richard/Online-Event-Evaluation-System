<?php include'../include/header.php';?>
<?php include'../include/topbar.php';?>
<?php include'../include/sidebar.php';?>
<?php include'../controller/dashboard.php';?>
<?php include'../include/session alert.php';?>
<main role="main" class="main-content"><a href="EvaluationForm.php" type="button" class="btn mb-2 btn-light">Back</a>
  <div class="col-md-8 card"> 
      <div class="card-header">
               <?php echo $_GET['title']; ?>Review My  Evaluation Form
            </div><br>
            <?php
session_start();
// Establish database connection
include '../../config/config.php';
include '../controller/controller.php';
$EventListID = $_GET['EventListID'];
$surveyQuestions = new SurveyQuestions($conn);
// Get questions for event with ID 1
$questions = $surveyQuestions->getQuestions($EventListID);
// Retrieve survey responses of participant ID 38 from the database
$participant_id = $_SESSION['user_id'];
$sql = "SELECT question_id, response_text FROM survey_responses WHERE ParticipantID = $participant_id";
$result = $conn->query($sql);
$responses = array();
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $responses[$row['question_id']] = $row['response_text'];
    }
}
?>  <!-- Display the survey responses of participant ID 38 -->
        <div class="container">
        <div class="row">
            <?php foreach ($questions as $question): ?>
            <div class="col-sm-12 mb-4">
                <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo $question['text']; ?></h5>
                    <?php if ($question['type'] === 'multiple_choice'): ?>
                    <?php foreach ($question['choices'] as $choice): ?>
                        <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="<?php echo 'question_' . $question['id']; ?>" id="<?php echo 'choice_' . $choice; ?>" value="<?php echo $choice; ?>" <?php if (isset($responses[$question['id']]) && $responses[$question['id']] === $choice) echo 'checked'; ?>>
                        <label class="form-check-label" for="<?php echo 'choice_' . $choice; ?>">
                            <?php echo $choice; ?>
                        </label>
                        </div>
                    <?php endforeach; ?>
                    <?php elseif ($question['type'] === 'open_ended'): ?>
                    <textarea class="form-control" id="<?php echo 'question_' . $question['id']; ?>" name="<?php echo 'question_' . $question['id']; ?>" rows="3"><?php if (isset($responses[$question['id']])) echo $responses[$question['id']]; ?></textarea>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
           </div>
        </div>
        <br>
      </div>
    </div>
  </div>
</main>

<?php include'../include/footer.php';?>
