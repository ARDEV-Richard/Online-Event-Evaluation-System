
<div class="modal fade" id="editschool-<?php echo $SchoolID; ?>" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="varyModalLabel">Edit School</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
            <form  method="post" action="../model/UpdateSchool.php" enctype="multipart/form-data" >
                    <input type="hidden" name="existing_logo" class="form-control" id="recipient-name" value="<?php echo $Image; ?>" />
                    <input type="hidden" name="SchoolID" value="<?php echo $SchoolID; ?>">
                    <div class="form-group">
                        <label for="editProductName" class="col-form-label">Name:</label>
                        <input type="text" name="name" id="" class="form-control" value="<?php echo $school['Name']; ?>" required>
                    </div>
                  <div class="form-group">
                        <label for="editProductName" class="col-form-label">Address:</label>
                        <textarea type="text" name="address" id="" class="form-control" value="" required><?php echo $school['Address']; ?></textarea>
                    </div>
                    
                    <div class="form-group">
                    <label for="recipient-name" class="col-form-label">Image:</label>
                    <input type="file" name="logo_image" class="form-control" id="recipient-name" onchange="previewImage(event)" value="<?php echo $Image; ?>" />
                    </div>
                    <div class="form-group text-center">
                    <?php if (!empty($Image)) { ?>
                        <img id="image-preview" src="../../uploads/<?php echo $Image; ?>" alt="Image Preview" style="max-width: 100%; max-height: 250px;">
                    <?php } else { ?>
                        <img id="image-preview" alt="No Image Preview" style="max-width: 40%; max-height: 150px; display: none;">
                    <?php } ?>
                    </div>
                    <script>
                    function previewImage(event) {
                    var input = event.target;
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();
                        reader.onload = function(e) {
                        var imagePreview = document.getElementById('image-preview');
                        imagePreview.style.display = 'block';
                        imagePreview.src = e.target.result;
                        }
                        reader.readAsDataURL(input.files[0]);
                    } else {
                        var imagePreview = document.getElementById('image-preview');
                        imagePreview.style.display = 'none';
                        imagePreview.removeAttribute('src');
                    }
                    }

                    // Set required attribute of file input to false if no file selected
                    var fileInput = document.querySelector('input[type=file]');
                    fileInput.addEventListener('change', function(event) {
                    if (!event.target.files || event.target.files.length == 0) {
                        event.target.required = false;
                    } else {
                        event.target.required = true;
                    }
                    });
                    </script>
        
                    <div class="modal-footer">
                        <button type="submit" name="submit" class="btn mb-2 btn-outline-success">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="editstudent-<?php echo $StudID ?>" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="varyModalLabel">View Student Info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form method="POST" action="../model/UpdateStudent.php">
            <input type="hidden" name="StudID" class="form-control" value="<?php echo $student['StudID']; ?>" required>
            <div class="modal-body">
               <div class="row">
                  <div class="col-6">
                     <h4>Personal Information</h4>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">First Name:</label>
                        <input type="text" name="first_name" class="form-control" value="<?php echo $student['first_name']; ?>" required>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Last Name:</label>
                        <input type="text" name="last_name" class="form-control" value="<?php echo $student['last_name']; ?>" required>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email:</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $student['email']; ?>" required>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Phone:</label>
                        <input type="number" name="phone" class="form-control" value="<?php echo $student['phone']; ?>" required>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Address:</label>
                        <textarea class="form-control" name="address" value="" required><?php echo $student['student_address']; ?></textarea>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">City:</label>
                        <input type="text" name="city" class="form-control" value="<?php echo $student['city']; ?>" required>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">State:</label>
                        <input type="text" name="state" class="form-control" value="<?php echo $student['state']; ?>" required>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Zip code:</label>
                        <input type="text" name="zip_code" class="form-control" value="<?php echo $student['zip_code']; ?>" required>
                     </div>
                  </div>
                    <div class="col-6">
                    <h4>School Name</h4>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">School Name :</label>
                        <select type="text" class="form-control form-control-md" name="SchoolID" required>
                            <?php
                                include '../../config/config.php';
                                $sql = "SELECT * FROM `school`";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)) {
                                    if ($row['SchoolID'] == $SchoolID) {
                                        echo '<option value="'.$row['SchoolID'].'" selected>'.$row['Name'].'</option>';
                                    } else {
                                        echo '<option value="'.$row['SchoolID'].'">'.$row['Name'].'</option>';
                                    }
                                }
                            ?>
                        </select>
                        </div>
                    <h4>Account Details</h4>
                    <div class="form-group">
                        <label for="account-number" class="col-form-label">Username:</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $student['first_name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="account-password" class="col-form-label">Password:</label>
                        <input type="password" name="password" class="form-control"  value="<?php echo $student['password']; ?>"  required>
                    </div>
                    <div class="form-group">
                        <label for="account-password" class="col-form-label">Confirm Password:</label>
                        <input type="password" name="confirm_password" class="form-control"  value="<?php echo $student['password']; ?>"  required>
                    </div>
                    </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit"  name="submit" class="btn mb-2 btn-outline-danger" >Submit</button>
            </div>
         </form>
      </div>
   </div>
</div>
</div>

<div class="modal fade" id="confirm-<?php echo $StudID ?>" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
   <div class="modal-dialog " role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="varyModalLabel">Student Confirmation </h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
                <p>Are you sure you want to confirm this student <b><?php echo $Name;?> ?</b> </p>
                <form id="" method="post" action="../model/UpdateStudentStatus.php">
                    <input type="hidden" name="StudID" value="<?php echo $StudID; ?>" />
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <button type="submit" name="submit" class="btn btn-danger">Confirm</button>
                    </div>
                </form>
            </div>
      </div>
   </div>
</div>
</div>