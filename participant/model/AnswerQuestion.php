<?php
include '../../config/config.php';
include '../controller/controller.php';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Loop through the submitted responses and insert them into the database
    foreach ($_POST as $key => $value) {
        if (strpos($key, 'question_') === 0) {
            $question_id = substr($key, strlen('question_'));
            if (is_array($value)) {
                $response_value = implode(',', $value);
                $response_text = '';
            } else {
                $response_value = '';
                $response_text = $value;
            }

            $Participant = $_SESSION['user_id'];
            $event_id = $_POST['event_id'];
            $SubmitAnswerQuestion = new SubmitAnswerQuestion($conn);
            $SubmitAnswerQuestion->SubmitAnswerQuestion($Participant, $event_id, $question_id, $response_text);
        }
    }

    $_SESSION['alert'] = 'success';
    $_SESSION['text'] = 'Answers submitted successfully';
    header('location:../views/EvaluationForm.php');
    exit;
} else {
    $_SESSION['alert'] = 'warning';
    $_SESSION['text'] = 'Something went wrong';
    header('location:../views/EvaluationForm.php');
    exit;
}
