<?php
include '../classes/class.request.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

switch($action) {
    case 'new':
        create_new_request();
        break;
    case 'update':
        update_request();
        break;
    case 'delete':
        delete_request();
        break;
    case 'status':
        update_request_status();
        break;
}

function create_new_request() {
    if (isset($_POST['userid'], $_POST['request_details'])) {
        $request = new Request();
        $user_id = $_POST['userid'];
        $request_details = $_POST['request_details'];
        
        // Insert the request into the database
        $result = $request->new_request($user_id, $request_details);
        if ($result) {
            // Redirect to the user's request page after success
            header('location: ../index.php?page=requests&id=' . $user_id);
            exit(); // Make sure to exit after redirect to prevent further execution
        }
    }
}

function update_request() {
    if (isset($_POST['requestid'], $_POST['request_details'])) {
        $request = new Request();
        $request_id = $_POST['requestid'];
        $request_details = $_POST['request_details'];
        
        // Update the request in the database
        $result = $request->update_request($request_id, $request_details);
        if ($result) {
            // Redirect to the user's request page after success
            header('location: ../index.php?page=requests&id=' . $_POST['userid']);
            exit(); // Ensure to stop further execution after redirect
        }
    }
}

function update_request_status() {
    if (isset($_POST['requestid'], $_POST['request_status'])) {
        $request = new Request();
        $request_id = $_POST['requestid'];
        $request_status = $_POST['request_status'];
        
        // Update the request status in the database
        $result = $request->update_request_status($request_id, $request_status);
        if ($result) {
            // Redirect to the user's request page after success
            header('location: ../index.php?page=requests&id=' . $_POST['userid']);
            exit();
        }
    }
}

function delete_request() {
    if (isset($_POST['requestid']) && is_numeric($_POST['requestid'])) {
        $request = new Request();
        $request_id = $_POST['requestid'];
        $user_id = $_POST['userid'];
        
        // Delete the request from the database
        $result = $request->delete_request($request_id);
        if ($result) {
            // Redirect to the user's request page after deletion
            header('location: ../index.php?page=requests&id=' . $user_id);
            exit();
        }
    }
}
?>
