<?php
include '../../config/config.php';
include '../controller/controller.php';
// Create an instance of LoadMessage class
$eventRepo = new EventRepository($conn);
$events = $eventRepo->getAllEvents();
echo json_encode($events);

?>
