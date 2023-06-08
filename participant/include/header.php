<?php
error_reporting(0);
session_start();
if (!isset($_SESSION['username'])) {
  header('Location:../index.php');
}
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="favicon.ico">
    <title>Event Evaluation Form</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="../css/simplebar.css">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="../assets/css/feather.css">
    <link rel="stylesheet" href="../assets/css/select2.css">
    <link rel="stylesheet" href="../assets/css/dropzone.css">
    <link rel="stylesheet" href="../assets/css/uppy.min.css">
    <link rel="stylesheet" href="../assets/css/jquery.steps.css">
    <link rel="stylesheet" href="../assets/css/jquery.timepicker.css">
    <link rel="stylesheet" href="../assets/css/quill.snow.css">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="../assets/css/daterangepicker.css">
    <!--- Calendar--->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.10.2/fullcalendar.min.css" />
    <!-- App CSS -->
    <link rel="stylesheet" href="../assets/css/app-light.css" id="lightTheme">
    <link rel="stylesheet" href="../assets/css/app-dark.css" id="darkTheme" disabled>
    <!--- sweet alert  --->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10.16.6/dist/sweetalert2.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;500;600;700&display=swap" rel="stylesheet">
   
  </head>
  <style>
  body { font-family:'Poppins', sans-serif; }
  .brand-sm {
    width:90%;
    height:100%;
  }
  .bg-success {
    background: url("../assets/images/banner 4.png"); 
    background-size: cover;
  }
  .page-item.active .page-link {
      z-index: 3;
      color: #f8f9fa;
      background-color: #005baa;
      border-color: #532990;
  }.text-success{
color:#532990;
  }.btn-outline-success {
    color: #532990;
    border-color: #532990;
}
  .table thead th {
      color: #fff;
      background-color: #3f74b6;
  } /* **********************************
Reset CSS
************************************** */
.fc-unthemed .fc-content, .fc-unthemed .fc-divider, .fc-unthemed .fc-list-heading td, .fc-unthemed .fc-list-view, .fc-unthemed .fc-popover, .fc-unthemed .fc-row, .fc-unthemed tbody, .fc-unthemed td, .fc-unthemed th, .fc-unthemed thead {
    border-color: #406cb954;
}
.fc-event, .fc-event-dot {
  background-color: #ddeffe;
    padding:10px;
}
.fc-state-active, .fc-state-down {
    background-color: #2196F3;
    background-image: none;
    box-shadow: inset 0 2px 4px rgb(226 158 158 / 15%), 0 1px 2px rgba(0,0,0,.05);
}
.fc-state-active, .fc-state-disabled, .fc-state-down, .fc-state-hover {
    color: #fff;
    background-color: #2196F3;
}h1, .h2, .h3, .h4, .h5, .h6, h1, h2, h3, h4, h5, h6, strong {
    color: #3f75b6;
}
</style>