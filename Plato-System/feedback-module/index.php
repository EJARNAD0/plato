<!DOCTYPE html>
<html>
<head>
    <title>Admin Feedback</title>
</head>
<body>
    <h1>Admin Feedback</h1>
    <div class="admin-info">
        <p>Admin: <span id="admin-name">Hello, <?php echo $_SESSION['username']; ?></span></p>
        <div class="dropdown">
            <button class="dropbtn">Menu</button>
            <div class="dropdown-content">
                <a href="admin-notification.php">Send Notification</a>
                <a href="feedback-module/admin-feedback.php?page=view">View Feedback</a>
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
                    <strong>Name:</strong> <?php echo $feedbackItem['user_firstname'] . ' ' . $feedbackItem['user_lastname']; ?> <br>
                    <strong>Feedback:</strong> <?php echo $feedbackItem['feedback']; ?> <br>
                    <strong>Submitted on:</strong> <?php echo $feedbackItem['timestamp']; ?>
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
    switch ($action) {
        case 'view':
            require_once 'feedback-module/admin-feedback.php'; // Page to view user profile
            break;
        default:
            require_once 'main.php'; // This should be the file that lists all users
            break;
    }
    ?>
</div>
    <script src="js/script.js"></script>
</body>
</html>
