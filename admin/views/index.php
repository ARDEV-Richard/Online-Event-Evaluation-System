

<?php include'../include/header.php';?>
  <?php include'../include/topbar.php';?>
  <?php include'../include/sidebar.php';?>
  <?php include'../controller/dashboard.php';?>
   <?php include'../include/session alert.php';?>
      
      <main role="main" class="main-content">
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
            <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-12">
              <div class="row">
               <div class="col-md-6 col-xl-6 mb-4">
                  <div class="card shadow bg-primary text-white border-0">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-3 text-center">
                          <span class="circle circle-sm bg-info-light">
                            <i class="fe fe-16 fe-users text-white mb-0"></i>
                          </span>
                        </div>
                        <div class="col pr-0">
                          <p class="small text-white mb-0">Total Participant</p>
                          <span class="h3 mb-0 text-white"><?php include'../controller/dashboard.php'; echo count($total_student);?></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md-6 col-xl-6 mb-4">
                  <div class="card shadow border-0">
                    <div class="card-body">
                      <div class="row align-items-center">
                        <div class="col-3 text-center">
                          <span class="circle circle-sm bg-info-light">
                            <i class="fe fe-book text-white mb-0"></i>
                          </span>
                        </div>
                        <div class="col pr-0">
                          <p class="small text-muted mb-0">Total Events</p>
                          <span class="h3 mb-0"><?php include'../controller/dashboard.php'; echo $total_events;?></span>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
             
              
                <div class="col-md-12">
                  <div class="card shadow mb-4">
                    <div class="card-header">
                      <strong>Event Results</strong>
                    </div>
                    <div class="card-body px-4">
                    <form method="get" action="">
                    <div class="form-row mb-3">
                        <div class="col-md-2 mt-2">
                            <label for="date-from"></label>
                            <div class="input-group">
                            <select class="form-control" id="select-option" name="event_id">
                            <option value="">Select Event</option>
                            <?php
                                include '../../config/config.php';
                                include '../controller/controller.php';
                                $AddEvent = new eventlist($conn);
                                $events = $AddEvent->eventlist();
                                while($event = $events->fetch_assoc()):
                            ?>
                            <option value="<?php echo $event['EventID']; ?>"><?php echo $event['title']; ?></option>
                            <?php endwhile; ?>
                            </select>

                            </div>
                        </div>
                        <div class="col-md-1 mb-3">
                            <label for="filter-button">&nbsp;</label>
                            <button type="submit" class="btn btn-primary btn-block" id="filter-button">Filter</button>
                          </div> 
                        </div>
                    </form>
                    <div class="my-4">
                <div id="lineChart"></div>
              </div>
                    
                <table class="table datatables" id="dataTable-1">
                                <thead>
                                <tr>
                                    <th>Response </th>
                                    <th>Count</th>
                                    <th>Percentage</th>
                                </tr>
                                </thead>
                                <tbody>
                                  
                                <?php
                                     include '../../config/config.php';
                                     include '../controller/fetchtable.php';
                                     $EventReport = new EventReport($conn);
                                     $eventID = $_GET['event_id']; // Replace with the desired event ID
                                     $result = $EventReport->EventReport($eventID);
                                    
                                    // Create an array to store the response counts and percentages
                                    $responses = array();
                                    
                                    // Iterate through the results
                                    while ($row = mysqli_fetch_assoc($result)) {
                                        $responseText = $row['response_text'];
                                        $questionId = $row['question_id'];
                                        
                                        // Increment the count for the specific question and response
                                        if (!isset($responses[$questionId])) {
                                            $responses[$questionId] = array();
                                        }
                                        
                                        if (!isset($responses[$questionId][$responseText])) {
                                            $responses[$questionId][$responseText] = 0;
                                        }
                                        
                                        $responses[$questionId][$responseText]++;
                                    }
                                    
                                    foreach ($responses as $questionId => $questionResponses) {
                                        // Calculate the total count for the question
                                        $totalCount = array_sum($questionResponses);
                                        
                                        foreach ($questionResponses as $responseText => $count) {
                                            // Calculate the percentage for each response
                                            $percentage = ($count / $totalCount) * 100;
                                ?>
                                <tr>
                                    <td><?php echo $responseText ?></td>
                                    <td><?php echo $count ?></td>
                                    <td><?php echo $percentage ?>%</td>
                                </tr>
                                <?php
                                    }
                                }
                                
                                mysqli_close($conn);
                                ?>
                                </tbody>
                            </table>

                            

 <!-- / .row -->
        </div><!-- / .list-group-item -->
      </div> <!-- / .list-group -->
    </div> <!-- / .card-body -->
  </div> <!-- / .card -->
              </div>
             
              
  <?php include'../include/footer.php';?>
  
 <script>
  