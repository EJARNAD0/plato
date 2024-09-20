<?php
// delete_feedback.php
require_once "config.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $feedbackId = $_POST["id"];

    // Delete feedback from database
    $sql = "DELETE FROM feedback WHERE id = '$feedbackId'";
    if ($conn->query($sql) === TRUE) {
        // Feedback deleted successfully
    } else {
        echo "Error deleting feedback: " . $conn->error;
    }
}
?>