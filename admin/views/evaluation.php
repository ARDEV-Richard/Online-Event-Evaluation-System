

<?php include'../include/header.php';?>
  <?php include'../include/topbar.php';?>
  <?php include'../include/sidebar.php';?>
  <?php include'../controller/dashboard.php';?>
   <?php include'../include/session alert.php';?>
      
      <main role="main" class="main-content" style="display:flex; justify-content:center;">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
            <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="row">
 <?php
// Establish database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'evaluating_db';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Loop through the submitted responses and insert them into the database
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'question_') === 0) {
            $question_id = substr($key, strlen('question_'));
            if (is_array($value)) {
                $response_value = implode(',', $value);
                $response_text = '';
            } else {
                $response_value = '';
                $response_text = $value;
            }
            $sql = "INSERT INTO survey_responses (event_id, question_id, response_text) VALUES (1, $question_id, '$response_text')";
            $result = $conn->query($sql);
        }
    }
}
// Retrieve survey questions from the database
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
<form method="post" action="">
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
                    <input class="form-check-input" type="radio" name="<?php echo 'question_' . $question['id']; ?>" id="<?php echo 'choice_' . $choice; ?>" value="<?php echo $choice; ?>">
                    <label class="form-check-label" for="<?php echo 'choice_' . $choice; ?>">
                      <?php echo $choice; ?>
                    </label>
                  </div>
                <?php endforeach; ?>
              <?php elseif ($question['type'] === 'open_ended'): ?>
                <textarea class="form-control" id="<?php echo 'question_' . $question['id']; ?>" name="<?php echo 'question_' . $question['id']; ?>" rows="3"></textarea>
              <?php endif; ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </div>
</form>


        </div><!-- / .list-group-item -->
      </div> <!-- / .list-group -->
    </div> <!-- / .card-body -->
  </div> <!-- / .card -->
              </div>
             
              
  <?php include'../include/footer.php';?>
 