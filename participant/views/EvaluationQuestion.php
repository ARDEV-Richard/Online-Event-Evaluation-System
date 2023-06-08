

<?php include'../include/header.php';?>
  <?php include'../include/topbar.php';?>
  <?php include'../include/sidebar.php';?>
  <?php include'../controller/dashboard.php';?>
   <?php include'../include/session alert.php';?>
      
      <main role="main" class="main-content" style="display:flex; justify-content:center;">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
            <div class="container-fluid"><h3 class="row no-gutters bg-success text-white" style="padding: 30px; border-radius: 10px;">
  Evaluation Form with <?php echo $_GET['title'];?>
        </h3><a href="EvaluationForm.php" type="button" class="btn mb-2 btn-light">Back</a>
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="row">
           <?php
        // Establish database connection
        include '../../config/config.php';
        include '../controller/controller.php';
        $EventListID = $_GET['EventListID'];
        $surveyQuestions = new SurveyQuestions($conn);
        // Get questions for event with ID 1
        $questions = $surveyQuestions->getQuestions($EventListID);
        ?>
        <form method="post" action="../model/AnswerQuestion.php">
          <input type = "hidden" name="event_id" value="<?php echo $_GET['EventListID'];?>" />
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
 