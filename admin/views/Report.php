<?php include'../include/header.php';?>
<?php include'../include/topbar.php';?>
<?php include'../include/sidebar.php';?>
<main role="main" class="main-content">
   <?php include'../include/session alert.php';?>
   <div class="container-fluid">
      <div class="row justify-content-center">
         <div class="col-12">
            <h3 class="row no-gutters bg-success text-white" style="padding: 30px; border-radius: 10px;">Evet Evaluation Report</h3>
            <!--<p class="card-text"></p> -->
            <div class="row my-4">
               <div class="col-md-12">
                  <div class="card shadow">
                     <div class="card-body">
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
                        <!-- table -->
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
             
                     </div>
                  </div>
               </div>
               <!-- simple table -->
            </div>
            <!-- end section -->
         </div>
         <!-- .col-12 -->
      </div>
      <!-- / .list-group-item -->
   </div>
   <!-- / .list-group -->
   <?php include'../include/footer.php';?>
   <?php include'modals/add.php';?>
</main>
