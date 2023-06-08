<!doctype html>
<html lang="en">
   <head>
      <title>Form</title>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
      <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.6.0/css/bootstrap.min.css" rel="stylesheet">
      <link rel="stylesheet" href="css/style.css">
   </head>
   <style>
   </style>
   <body>
      <section class="ftco-section">
      <div class="container">
      <div class="row justify-content-center">
      <div class="col-md-12 col-lg-10">
      <div class="wrap d-md-flex">
      <div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center order-md-last">
         <div class="text w-100">
            <h2>Welcome to Event Evaluating System</h2>
            <p>Don't have an account?</p>
            <div class="d-flex justify-content-center">
               <div class="btn-group">
                  <button type="button" class="btn btn-white btn-outline-white active" id="signin-btn">Sign In</button>
                  <button type="button" class="btn btn-white btn-outline-white" id="signup-btn">Sign Up</button>
               </div>
            </div>
         </div>
      </div>
      <div class="login-wrap p-4 p-lg-5">
      <div class="d-flex">
         <div class="w-100">
         </div>
         <!-- <div class="w-100">
            <p class="social-media d-flex justify-content-end">
               <a href="#" class="social-icon d-flex align-items-center justify-content-center"><span class="fa fa-google"></span></a>
            </p>
         </div> -->
      </div>
      <form class="signin-form" method="post">
     <h3 class="mb-4">Sign In</h3>
   <div class="form-group">
      <label for="username">Username</label>
      <input type="text" class="form-control" id="username" name="username" >
      <div class="invalid-feedback text-danger"></div>
   </div>
   <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" id="password" name="password" >
      <div class="invalid-feedback text-danger"></div>
      </div>
         <div class="form-group">
            <button type="submit" class="form-control btn btn-primary submit px-3">Sign In</button>
         </div>
         <div class="form-group d-md-flex">
            <div class="w-50 text-left">
               <label class="checkbox-wrap checkbox-primary mb-0">Remember Me
               <input type="checkbox" checked>
               <span class="checkmark"></span>
               </label>
            </div>
            <!-- <div class="w-50 text-md-right">
               <a href="#">Forgot Password</a>
            </div> -->
         </div>
      </form>
      <form action="#" class="signup-form" style="display:none">
    <h3 class="mb-4">Sign Up</h3>

   
    <div class="form-group mb-3">
        <label class="label" for="first_name">First Name</label>
        <input type="text" class="form-control" placeholder="First Name" name="first_name" id="first_name" required>
    </div>
    <div class="form-group mb-3">
        <label class="label" for="last_name">Last Name</label>
        <input type="text" class="form-control" placeholder="Last Name" name="last_name" id="last_name" required>
    </div>
    <div class="form-group mb-3">
        <label class="label" for="username">Username</label>
        <input type="text" class="form-control" placeholder="Username" name="username" id="username" required>
    </div>
    <div class="form-group mb-3">
        <label class="label" for="email">Email</label>
        <input type="email" class="form-control" placeholder="Email" name="email" id="email" required>
    </div>
    <div class="form-group mb-3">
        <label class="label" for="password">Password</label>
        <input type="password" class="form-control" placeholder="Password" name="password" id="password" required>
    </div>
    <div class="form-group mb-3">
        <label class="label" for="confirm_password">Confirm Password</label>
        <input type="password" class="form-control" placeholder="Confirm Password" name="confirm_password" id="confirm_password" required>
    </div>
    <div class="form-group">
        <button type="submit" class="form-control btn btn-primary submit px-3">Sign Up</button>
    </div>
</form>
   </body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="js/form.js"></script>
<script>
   
    $(document).ready(function() {
  // Listen for the form submission event
  $('.signup-form').submit(function(event) {
    event.preventDefault(); // Prevent the form from submitting via the browser
    // Get the form data
    var formData = $(this).serialize();
    // Display a loading animation while the AJAX request is in progress
    $('.signup-form .alert').remove();
    $('.signup-form').prepend('<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>');
    // Submit the form data via AJAX
    
    $.ajax({
      url: 'model/signup.php', // Replace with the URL of your PHP script
      type: 'POST',
      data: formData,
      dataType: 'json',
      success: function(response) {
        $('.signup-form .text-center').remove(); // Remove the loading animation
        if (response.success) {
          // Show success notification
          $('.signup-form').prepend('<div class="text-center alert alert-success "><div class="spinner-border text-success" role="status"></div> Signup success...</div>');
          setTimeout(function(){
                  window.location.href = 'index.php'; // Replace with the URL of your dashboard or other page
               }, 3000);
        } else {
          // Display any validation errors or error message
          if (response.errors) {
            $.each(response.errors, function(key, value) {
              $('input[name=' + key + ']').addClass('is-invalid');
              $('input[name=' + key + ']').siblings('.text-danger').text(value);
            });
          } else {
            // Prepend the alert to the sign-up form
            $('.signup-form').prepend('<div class="text-center alert alert-danger"><div class="spinner-border text-danger" role="status"></div>' + response.message + '</div>');
          }
        }
      },
      error: function(xhr, status, error) {
        console.log(xhr);
        console.log(status);
        console.log(error);
      }
    });
  });
  // Remove the validation error messages when the user starts typing in an input field
  $('.signup-form input').on('input', function() {
    $(this).removeClass('is-invalid');
    $(this).addClass('is-valid'); // Add success color
    $(this).siblings('.text-danger').text('');
  });
});

$(document).ready(function() {
  $('form.signin-form').submit(function(e) {
    e.preventDefault(); // prevent form from submitting normally
    var username = $('#username').val();
    var password = $('#password').val();
    var role = $('#role').val();
    // Display a loading animation while the AJAX request is in progress
    $('.signin-form').prepend('<div class="text-center"><div class="spinner-border" role="status"><span class="sr-only">Loading...</span></div></div>');
    $.ajax({
      type: 'POST',
      url: 'model/signin.php',
      data: {
        username: username,
        password: password,
        role: role
      },
      dataType: 'json',
      success: function(data) {
        $('.signin-form .text-center').remove(); // Remove the loading animation
        var role = data.role;
        
        if (role == 'admin') {
          // handle admin login
          $('.signin-form').prepend('<div class="text-center alert alert-success "><div class="spinner-border text-success" role="status"></div> Login success...</div>');
          // Redirect the user to the dashboard or another page after 3 seconds
          setTimeout(function(){
            window.location.href = 'admin/views/index.php'; // redirect to admin dashboard
          }, 3000);
        } else if (role == 'participant') {
          // handle user login
           $('.signin-form').prepend('<div class="text-center alert alert-success "><div class="spinner-border text-success" role="status"></div> Login success...</div>');
          // Redirect the user to the dashboard or another page after 3 seconds
          setTimeout(function(){
            window.location.href = 'participant/views/EvaluationForm.php'; // redirect to user profile
          }, 3000);
        } else {
          // handle invalid login
          if (data.message) {
            // Display the error message
            // Add input error message for incorrect password
            $('#username').addClass('is-invalid');
            $('#username').siblings('.invalid-feedback').text('Incorrect username');
            $('#password').addClass('is-invalid');
            $('#password').siblings('.invalid-feedback').text('Incorrect password');
          } else {
            // Display a generic error message
            $('.signin-form').prepend('<div class="text-center alert alert-danger"><div class="spinner-border text-danger" role="status"></div>An error occurred while processing your request.</div>');
          }
        }
      },
      error: function(xhr, status, error) {
        // handle login error
        $('.signin-form .text-center').remove(); // Remove the loading animation
        $('.signin-form').prepend('<div class="text-center alert alert-danger"><div class="spinner-border text-danger" role="status"></div>Oops! An error occurred while submitting your request. Please try again later.</div>');
}
    });
  });
  // Remove the validation error messages when the user starts typing in an input field
  $('.signin-form input').on('input', function() {
    $(this).removeClass('is-invalid');
    $(this).addClass('is-valid'); // Add success color
    $(this).siblings('.text-danger').text('');
  });
});



</script>