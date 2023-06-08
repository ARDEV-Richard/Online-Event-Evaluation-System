<?php
include '../../config/config.php';
include '../controller/controller.php';
// Check if the form has been submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $EventListID = $_POST['EventListID'];
    $questions = $_POST['question'];
    $questionnaireTypes = $_POST['questionnaireType'];
    $multipleChoices = $_POST['multipleChoice'];

    // Create a new instance of InsertSurveyQuestions
    $insertSurveyQuestions = new InsertSurveyQuestions($conn);

    // Call the insertQuestions function to insert the survey questions into the database
    $result= $insertSurveyQuestions->insertQuestions($EventListID,$questions, $questionnaireTypes, $multipleChoices);

    // If successful, redirect to the dashboard or other page  
    $_SESSION['alert'] = 'success';
    $_SESSION['text'] = 'Evaluation questions successfully created';
    header('location: ../views/EventCalendar.php');
    exit;
 
}
?>
