<?php include'../include/header.php';?>
<?php include'../include/topbar.php';?>
<?php include'../include/sidebar.php';?>
<?php include'../controller/dashboard.php';?>
<?php include'../include/session alert.php';?>
<main role="main" class="main-content">
  <div class="container-fluid"> <h3 class="row no-gutters bg-success text-white" style="padding: 30px; border-radius: 10px;">
  Evaluation Form
        </h3>
    <div class="row">
      <div class="col-md-4">
        <div class="row d-flex flex-wrap">
          <div class="col-sm-12 card">
            <div class="card-header">
            Event List
            </div>
            <div class="card">
            <div class="card-body">
              <form action="../model/SearchEvent.php" method="get" class="mb-3">
                <div class="input-group">
                  <input type="text" name="q" class="form-control" placeholder="Search events">
                  <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Search</button>
                  </div>
                </div>
              </form>
                 <div id="eventList"></div>
            </div>
          </div>
          </div>
        </div>
      </div>
      <div class="col-md-8 card"> 
      <div class="card-header">
      <?php echo $_GET['title']; ?> Evaluation Form
     </div>
     <br>
        <?php
        // Establish database connection
        include '../../config/config.php';
        include '../controller/controller.php';
        $EventListID = $_GET['EventListID'];
        $surveyQuestions = new SurveyQuestions($conn);
        // Get questions for event with ID 1
        $questions = $surveyQuestions->getQuestions($EventListID);
        ?>
        <form method="post" action="#">
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
          </div>
        </form><br>
      </div>
    </div>
  </div>
</main>
<?php include'../include/footer.php';?>
<script>
  
// In your JavaScript code
$(document).ready(function() {
  function loadEventList(searchTerm) {
    $.ajax({
      url: '../model/SearchEvent.php',
      type: 'GET',
      data: {
        q: searchTerm
      },
      success: function(response) {
        $('#eventList').html(response);
        // Add a click event to each event
        $('.event-link').click(function() {
          var eventId = $(this).data('id');
          // You can add more code here to perform additional actions
        });
      },
      error: function(xhr, status, error) {
        console.error(xhr.responseText);
      }
    });
  }

  // Load the initial list of events
  loadEventList('');

  // Handle the search form submission
  $('form').submit(function(event) {
    event.preventDefault();
    var searchTerm = $('input[name="q"]').val();
    loadEventList(searchTerm);
  });
});
</script>