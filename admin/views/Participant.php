<?php include'../include/header.php';?>
<?php include'../include/topbar.php';?>
<?php include'../include/sidebar.php';?>
<main role="main" class="main-content">
   <?php include'../include/session alert.php';?>
   <div class="container-fluid">
      <div class="row justify-content-center">
         <div class="col-12">
            <h3 class="row no-gutters bg-success text-white" style="padding: 30px; border-radius: 10px;">Participant Users</h3>
            <!--<p class="card-text"></p> -->
            <div class="row my-4">
               <!-- 
                  upload  image with multiple array
                  
                  <div class="card-body">
                    <div id="drag-drop-area"></div>
                  </div> 
                  -->
               <!-- Small table -->
               <div class="col-md-12">

                  <div class="card shadow">
                     <div class="card-body">
                        <!-- table -->
                        <table class="table datatables" id="dataTable-1">
                           <thead>
                              <tr>
                                 <th>Name</th>
                                 <th>Email</th>
                                 <th>Phone</th>
                                 <th>Address</th>
                                 <th>Username</th>
                                 <th></th>
                              </tr>
                           </thead>
                           <tbody>
                           <?php 
                              include '../../config/config.php';
                              include '../controller/fetchtable.php';
                              $FetchParticipantTable = new FetchParticipantTable($conn);
                              $students = $FetchParticipantTable->FetchParticipantTable();
                              while($student = $students->fetch_assoc()):
                                 $StudID = $student['UserID'];
                                 $Name = $student['full_name'];
                                 $email = $student['email'];
                                 $phone = $student['phone'];
                                 $address = $student['address'];
                                 $username = $student['username'];  
                              ?>
                             <tr class="product-row">
                              <td><?php echo $Name ?></td>
                              <td><?php echo $email ?></td>
                              <td><?php echo $phone ?></td>
                              <td><?php echo $address ?></td>
                              <td><?php echo $username ?></td>
                              <td>
                                 <div class="btn-group" role="group" aria-label="Basic example">
                                    <button type="button" class="btn mb-2 btn-default" data-toggle="modal" data-target="#viewstudent-<?php echo $StudID ?>"><i class="fe fe-eye text-dark"></i></button>
                                     <button type="button" class="btn mb-2 btn-default" data-toggle="modal" data-target="#deletestudent-<?php echo $StudID ?>"><i class="fe fe-trash-2 text-dark"></i></button>
                                 </div>
                              </td>
                           </tr>
                           <?php include 'modals/delete.php';?>
                           <?php include 'modals/edit.php';?>
                           <?php include 'modals/view.php';?>
                           <?php endwhile; ?>
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
