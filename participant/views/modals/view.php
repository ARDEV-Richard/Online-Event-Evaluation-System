
<div class="modal fade" id="viewschool-<?php echo $SchoolID; ?>" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
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
                    <input type="hidden" name="existing_logo" class="form-control" id="recipient-name" value="<?php echo $Image; ?>" readonly/>
                    <input type="hidden" name="SchoolID" value="<?php echo $SchoolID; ?>">
                    <div class="form-group">
                        <label for="editProductName" class="col-form-label">Name:</label>
                        <input type="text" name="name" id="" class="form-control" value="<?php echo $school['Name']; ?>" readonly>
                    </div>
                  <div class="form-group">
                        <label for="editProductName" class="col-form-label">Address:</label>
                        <textarea type="text" name="address" id="" class="form-control" value="" readonly><?php echo $school['Address']; ?></textarea>
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
                        <button type="submit" name="submit" class="btn mb-2 btn-outline-danger" data-dismiss="modal" aria-label="Close">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="viewstudent-<?php echo $StudID ?>" tabindex="-1" role="dialog" aria-labelledby="varyModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="varyModalLabel">View Participant Info</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <form method="POST" action="#">
            <div class="modal-body">
               <div class="row">
                  <div class="col-6">
                     <h5>Personal Information</h5>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">First Name:</label>
                        <input type="text" name="first_name" class="form-control" value="<?php echo $student['first_name']; ?>" readonly>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Last Name:</label>
                        <input type="text" name="last_name" class="form-control" value="<?php echo $student['last_name']; ?>" readonly>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Email:</label>
                        <input type="email" name="email" class="form-control" value="<?php echo $student['email']; ?>" readonly>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Phone:</label>
                        <input type="number" name="phone" class="form-control" value="<?php echo $student['phone']; ?>" readonly>
                     </div>
                     <div class="form-group">
                        <label for="recipient-name" class="col-form-label">Address:</label>
                        <textarea class="form-control" name="address" value="" readonly><?php echo $student['address']; ?></textarea>
                     </div>
                    
                  </div>
                    <div class="col-6">
                     
                    <h5>Account Details</h5>
                    <div class="form-group">
                        <label for="account-number" class="col-form-label">Username:</label>
                        <input type="text" name="username" class="form-control" value="<?php echo $student['first_name']; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="account-password" class="col-form-label">Password:</label>
                        <input type="text" name="password" class="form-control"  value="<?php echo $student['password']; ?>"  readonly>
                    </div>
                    
                    </div>
               </div>
            </div>
            <div class="modal-footer">
               <button type="button"  class="btn mb-2 btn-outline-danger" data-dismiss="modal" aria-label="Close">Close</button>
            </div>
         </form>
      </div>
   </div>
</div>
</div>