<?php
// Include necessary files
include_once 'classes/class.notification.php';
include_once 'config/config.php';

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $recipient = $_POST['recipient'];
    $title = $_POST['title'];
    $message = $_POST['message'];

    // Create an instance of the Notification class
    $notification = new Notification();

    // Send the notification
    if ($notification->send($recipient, $title, $message)) {
        echo "Notification sent successfully!";
    } else {
        echo "Failed to send notification.";
    }
}
?>
