<?php
include '../classes/class.user.php';

$action = isset($_GET['action']) ? $_GET['action'] : '';
$id= isset($_GET['id']) ? $_GET['id'] : '';
$status= isset($_GET['status']) ? $_GET['status'] : '';

switch($action){
	case 'new':
        create_new_user();
	break;
    case 'update':
        update_user();
	break;
    case 'status':
        change_user_status();
	break;
    case 'updatepassword':
        change_user_password();
	break;
    case 'updateusername':
        change_username();
	break;
}

function create_new_user(){
	$user = new User();
    $username = $_POST['username'];
    $lastname = ucwords($_POST['lastname']);
    $firstname = ucwords($_POST['firstname']);
    $access = ucwords($_POST['access']);
    $password = $_POST['password'];
    $confirmpassword = $_POST['confirmpassword'];
    $password = ($password);
    $result = $user->new_user($username,$password,$lastname,$firstname,$access);
    if($result){
        $id = $user->get_user_id($username);
        header('location: ../index.php?page=settings&subpage=users&action=profile&id='.$id);
    }
}

function update_user(){
	$user = new User();
    $user_id = $_POST['userid'];
    $lastname = ucwords($_POST['lastname']);
    $firstname = ucwords($_POST['firstname']);
    $access = ucwords($_POST['access']);
   
    
    $result = $user->update_user($lastname,$firstname,$access,$user_id);
    if($result){
        header('location: ../index.php?page=settings&subpage=users&action=profile&id='.$user_id);
    }
}

function change_user_status(){
	$user = new User();
    $id= isset($_GET['id']) ? $_GET['id'] : '';
    $status= isset($_GET['status']) ? $_GET['status'] : '';
    $result = $user->change_user_status($id,$status);
    if($result){
        header('location: ../index.php?page=settings&subpage=users&action=profile&id='.$id);
    }
}

function change_user_password(){
	$user = new User();
    $id = $_POST['userid'];
    $current_password = $_POST['crpassword'];
    $new_password =($_POST['npassword']);
    $confirm_password = $_POST['copassword'];
    $result = $user->change_password($id,$new_password);
    if($result){
        header('location: ../index.php?page=settings&subpage=users&action=profile&id='.$id);
    }
}

function change_username(){
	$user = new User();
    $id = $_POST['userid'];
    $current_username = $_POST['username'];
    $new_username = $_POST['newusername'];
    $current_password = $_POST['crpassword'];
    $result = $user->change_username($id,$new_username);
    if($result){
        header('location: ../index.php?page=settings&subpage=users&action=profile&id='.$id);
    }
}
function delete_user(){
    if (isset($_POST['userid']) && is_numeric($_POST['userid'])) {
        $user = new User();
        $userid = $_POST['userid'];
        $result = $user->delete_user($userid);
        if ($result) {
            header('location: ../index.php?page=settings&subpage=users&action=profile&id='.$user);
        } 
    }
}