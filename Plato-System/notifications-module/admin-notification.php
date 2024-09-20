<?php
// Include necessary files
include_once 'classes/class.user.php';
include 'config/config.php';
include 'classes/notification.php';

// Instantiate User class and check session
$user = new User();
$notification = new Notification();

if(!$user->get_session()){
    header("location: login.php");
}

$user_id = $user->get_user_id($_SESSION['username']);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Plato - Send Notification</title>
    <link rel="stylesheet" href="css/style.css?<?php echo time();?>">
</head>
<body>
    <h1>Send Notification</h1>
    <div class="notification-form">
        <form action="send_notification.php" method="POST">
            <div class="form-group">
                <label for="recipient">Recipient User ID:</label>
                <input type="text" id="recipient" name="recipient" placeholder="Enter User ID" required>
            </div>

            <div class="form-group">
                <label for="title">Notification Title:</label>
                <input type="text" id="title" name="title" placeholder="Enter notification title" required>
            </div>

            <div class="form-group">
                <label for="message">Notification Message:</label>
                <textarea id="message" name="message" placeholder="Enter notification message" rows="5" required></textarea>
            </div>

            <div class="form-group">
                <button type="submit" class="btn-send">Send Notification</button>
            </div>
        </form>
    </div>

    <script src="js/script.js"></script>
</body>
</html>
