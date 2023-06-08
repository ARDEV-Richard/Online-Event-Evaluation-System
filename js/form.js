$(document).ready(function() {
    $("#signin-btn").click(function() {
      $(".signup-form").fadeOut(300, function() {
        $(".signin-form").fadeIn(300);
      });
    });
  
    $("#signup-btn").click(function() {
      $(".signin-form").fadeOut(300, function() {
        $(".signup-form").fadeIn(300);
      });
    });
  });
  