<?php
include '../classes/class.feedback.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

switch($action) {
    case 'new':
        create_new_feedback();
        break;
    case 'update':
        update_feedback();
        break;
    case 'delete':
        delete_feedback();
        break;
}

function create_new_feedback() {
    $feedback = new Feedback();
    $user_id = $_POST['userid'];
    $user_feedback = $_POST['feedback'];
    
    // Insert the feedback into the database
    $result = $feedback->new_feedback($user_id, $user_feedback);
    if ($result) {
        // Redirect to the user's feedback page after success
        header('location: ../index.php?page=feedback&id=' . $user_id);
    }
}

function update_feedback() {
    $feedback = new Feedback();
    $feedback_id = $_POST['feedbackid'];
    $user_feedback = $_POST['feedback'];
    
    // Update the feedback in the database
    $result = $feedback->update_feedback($feedback_id, $user_feedback);
    if ($result) {
        // Redirect to the user's feedback page after success
        header('location: ../index.php?page=feedback&id=' . $_POST['userid']);
    }
}

function delete_feedback() {
    if (isset($_POST['feedbackid']) && is_numeric($_POST['feedbackid'])) {
        $feedback = new Feedback();
        $feedback_id = $_POST['feedbackid'];
        $user_id = $_POST['userid'];
        
        // Delete the feedback from the database
        $result = $feedback->delete_feedback($feedback_id);
        if ($result) {
            // Redirect to the user's feedback page after deletion
            header('location: ../index.php?page=feedback&id=' . $user_id);
        }
    }
}
