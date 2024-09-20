<?php
include '../classes/class.request.php'; // Include the Request class

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

switch ($action) {
    case 'new':
        create_new_request();
        break;
    case 'update':
        update_request();
        break;
    case 'delete':
        delete_request();
        break;
}

function create_new_request() {
    $request = new Request();
    $user_id = $_POST['userid'];
    $request_details = $_POST['request_details'];
    
    // Insert the request into the database
    $result = $request->new_request($user_id, $request_details);
    if ($result) {
        // Redirect to the user's request page after success
        header('location: ../index.php?page=requests&subpage=user&id=' . $user_id);
    }
}

function update_request() {
    $request = new Request();
    $request_id = $_POST['requestid'];
    $request_details = $_POST['request_details'];
    $request_status = $_POST['request_status']; // Assuming you have a status field
    
    // Update the request in the database
    $result = $request->update_request($request_id, $request_details, $request_status);
    if ($result) {
        // Redirect to the user's request page after success
        header('location: ../index.php?page=requests&subpage=user&id=' . $_POST['userid']);
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
            header('location: ../index.php?page=requests&subpage=user&id=' . $user_id);
        }
    }
}
?>
