
<?php
session_start();
include '../../config/config.php';
include '../controller/controller.php';

// Initialize the DeleteSchool class with the database connection
$DeleteParticipation = new DeleteParticipation($conn);

// Check if the form was submitted
if (isset($_POST['submit'])) {
  $UserID = $_POST['UserID'];  
  $result = $DeleteParticipation->DeleteParticipation($UserID);
  if ($result) {
    // If successful, redirect to the dashboard or other page  
    $_SESSION['alert'] = 'success';
    $_SESSION['text'] = 'Participant deleted successfully';
    header('location: ../views/Participant.php');
    exit;
  } else {
    // If unsuccessful, display an error message
    $_SESSION['alert'] = 'error';
    $_SESSION['text'] = 'Failed to delete participant';
    header('location: ../views/Participant.php');
    exit;
  }
} else {
  // If form was not submitted, display an error message
  $_SESSION['alert'] = 'warning';
  $_SESSION['text'] = 'Something went wrong';
  header('location: ../views/Participant.php');
  exit;
}
?>
