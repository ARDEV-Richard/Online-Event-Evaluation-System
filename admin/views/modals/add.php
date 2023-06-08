<div class="modal fade" id="addschools" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="varyModalLabel">New School</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <form method="POST" action="../model/AddSchool.php" enctype="multipart/form-data">
               <div class="form-group">
                  <label for="recipient-name" class="col-form-label">Name:</label>
                  <input type="text" name="name" class="form-control" id="recipient-name" required />
               </div>
               <div class="form-group">
                  <label for="message-text" class="col-form-label">Complete Addrss:</label>
                  <textarea class="form-control" name="address" id="message-text" required></textarea>
               </div>
               <div class="form-group">
                  <label for="review-image" class="col-form-label">Review Image:</label>
                  <input type="file" name="logo_image" class="form-control" id="review-image" onchange="previewReviewImage(event)" required />
               </div>
               <div class="form-group text-center">
                  <img id="review-image-preview" src="#" alt="Review Image Preview" style="max-width: 40%; max-height: 150px; display: none;" />
               </div>
               <script>
                  function previewReviewImage(event) {
                      var input = event.target;
                      if (input.files && input.files[0]) {
                          var reader = new FileReader();
                          reader.onload = function(e) {
                              var imagePreview = document.getElementById('review-image-preview');
                              imagePreview.style.display = 'block';
                              // set the src attribute of the image to the URL of the selected image
                              imagePreview.src = e.target.result;
                          }
                          reader.readAsDataURL(input.files[0]);
                      }
                  }
               </script>
               <div class="modal-footer">
                  <button type="submit" name="submit" class="btn mb-2 btn-outline-success">Save</button>
               </div>
            </form>
         </div>
      </div>
   </div>
</div>
<div class="modal fade" id="addstudent" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="varyModalLabel">New Student</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form method="POST" action="../model/AddStudent.php">
            <div class="modal-body">
               <div class="row">
                  <div class="col-6">
                     <h4>Personal Information</h4>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">First Name:</label>
                        <input type="text" name="first_name" class="form-control" required>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Last Name:</label>
                        <input type="text" name="last_name" class="form-control" required>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email:</label>
                        <input type="email" name="email" class="form-control" required>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Phone:</label>
                        <input type="number" name="phone" class="form-control" required>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Address:</label>
                        <textarea class="form-control" name="address" required></textarea>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">City:</label>
                        <input type="text" name="city" class="form-control" required>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">State:</label>
                        <input type="text" name="state" class="form-control" required>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Zip code:</label>
                        <input type="text" name="zip_code" class="form-control" required>
                     </div>
                  </div>
                    <div class="col-6">
                    <h4>School Name</h4>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">School Name :</label>
                        <select type="text" class="form-control form-control-md" name="SchoolID" required>
                            <option selected disabled value="">Select..</option>
                            <?php
                                include '../../config/config.php';
                                $sql = "SELECT * FROM `school`";
                                $result = mysqli_query($conn, $sql);
                                while($row = mysqli_fetch_assoc($result)) {
                                    echo '<option value="'.$row['SchoolID'].'">'.$row['Name'].'</option>';
                                }
                            ?>
                        </select>
                        </div>
                    <h4>Account Details</h4>
                    <div class="form-group">
                        <label for="account-number" class="col-form-label">Username:</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="account-password" class="col-form-label">Password:</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="account-password" class="col-form-label">Confirm Password:</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>
                    </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="submit" name="submit" class="btn mb-2 btn-outline-success">Save</button>
            </div>
         </form>
      </div>
   </div>
</div>
</div>