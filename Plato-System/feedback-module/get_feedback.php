<?php
// get_feedback.php
require_once "config.php";

// Fetch feedback from database
$sql = "SELECT * FROM feedback";
$result = $conn->query($sql);

$feedbackData = array();
if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $feedbackData[] = $row;
    }
}

// Send response as JSON
header('Content-Type: application/json');
echo json_encode($feedbackData);
?>