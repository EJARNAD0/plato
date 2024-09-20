<?php
// Include necessary files
include_once 'classes/class.user.php';
include_once 'classes/class.feedback.php';
include 'config/config.php';

// Start session
session_start();

// Instantiate User and Feedback classes
$user = new User();
$feedback = new Feedback();

// Check if user is logged in
if(!$user->get_session()){
    header("location: login.php");
    exit();
}

$user_id = $user->get_user_id($_SESSION['username']);
$feedbackList = $feedback->get_all_feedback(); // Get all feedback
?>

<!DOCTYPE html>
<html>
<head>
    <title>Admin Feedback</title>
</head>
<body>
    <h1>Admin Feedback</h1>
    <div class="admin-info">
        <p>Admin: <span id="admin-name">Hello, <?php echo htmlspecialchars($_SESSION['username']); ?></span></p>
        <div class="dropdown">
            <button class="dropbtn">Menu</button>
            <div class="dropdown-content">
                <a href="admin-notification.php">Send Notification</a>
                <a href="admin-feedback.php">View Feedback</a>
                <a href="logout.php">Logout</a>
            </div>
        </div>
    </div>

    <div class="content">
        <h2>All User Feedback</h2>
        <ul id="feedback-list">
            <?php if(!empty($feedbackList)): ?>
                <?php foreach ($feedbackList as $feedbackItem): ?>
                    <li>
                        <strong>User ID:</strong> <?php echo htmlspecialchars($feedbackItem['user_id']); ?> <br>
                        <strong>Feedback:</strong> <?php echo htmlspecialchars($feedbackItem['feedback']); ?> <br>
                        <strong>Submitted on:</strong> <?php echo htmlspecialchars($feedbackItem['timestamp']); ?>
                    </li>
                <?php endforeach; ?>
            <?php else: ?>
                <li>No feedback available.</li>
            <?php endif; ?>
        </ul>
    </div>

    <div id="subcontent">
        <?php
        // Handle different actions based on the query string
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        switch ($action) {
            case 'modify':
                require_once 'modify-user.php'; // Page for modifying a user
                break;
            case 'profile':
                require_once 'view-profile.php'; // Page to view user profile
                break;
            case 'result':
                require_once 'search-user.php'; // Page to display search results
                break;
            default:
                require_once 'main.php'; // Default page to list all users
                break;
        }
        ?>
    </div>

    <script src="js/script.js?<?php echo time(); ?>"></script>
</body>
</html>
