<?php
// Include the necessary files
include_once 'classes/class.user.php';
include_once 'classes/class.feedback.php';
include 'config/config.php';

// Get necessary variables from URL if they exist
$page = isset($_GET['page']) ? $_GET['page'] : '';
$subpage = isset($_GET['subpage']) ? $_GET['subpage'] : '';
$action = isset($_GET['action']) ? $_GET['action'] : '';
$id = isset($_GET['id']) ? $_GET['id'] : '';

// Instantiate User class and check session
$user = new User();
$feedback = new Feedback();
if (!$user->get_session()) {
    header("Location: login.php");
    exit();
}
$user_id = $user->get_user_id($_SESSION['username']);

// Fetch feedback data
$feedbackList = $feedback->get_all_feedback(); // Make sure you have this method implemented in class.feedback.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Plato Admin Panel</title>
    <link rel="stylesheet" href="css/style.css?<?php echo time(); ?>">
</head>
<body>
    <h1>Plato</h1>
    <div class="admin-info">
        <div class="admin-menu">
            <p>Admin: <span id="admin-name">Hello, <?php echo $_SESSION['username']; ?></span></p>
            <div class="dropdown">
                <button class="dropbtn">Menu</button>
                <div class="dropdown-content">
                    <a href="admin-notification.php">Send Notification</a>
                    <a href="index.php?page=users">Settings</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <!-- Feedback Section (Hide if 'users' page is selected) -->
        <div class="section user-feedback <?php echo ($page == 'users') ? 'hidden' : ''; ?>">
            <h2><a href="index.php?page=feedback">User Feedback</a></h2>
            <ul id="feedback-list">
                <?php if (!empty($feedbackList)): ?>
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
        <!-- Logs Section -->
        <div class="section logs <?php echo ($page == 'users') ? 'hidden' : ''; ?>">
            <h2>Logs</h2>
            <ul id="transaction-list">
                <!-- Transaction items will be loaded here -->
            </ul>
        </div>
        <!-- Maps Section -->
        <div class="section maps <?php echo ($page == 'users') ? 'hidden' : ''; ?>">
            <h2>Maps</h2>
            <div id="map-container">
                <iframe src="https://www.google.com/maps/embed?pb=!1m16!1m12!1m3!1d126529.29762456423!2d121.02823879999999!3d14.5579289!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!2m1!1sPhilippines!5e0!3m2!1sen!2sph!4v1698038142641!5m2!1sen!2sph" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
        <!-- Approval Requests Section -->
        <div class="section approval-requests <?php echo ($page == 'users') ? 'hidden' : ''; ?>">
            <h2>Approval of Requests</h2>
            <ul id="request-list">
                <?php if (!empty($requestList)): ?>
                    <?php foreach ($requestList as $request): ?>
                        <li>
                            <strong>Request ID:</strong> <?php echo $request['id']; ?> <br>
                            <strong>User ID:</strong> <?php echo $request['user_id']; ?> <br>
                            <strong>Request:</strong> <?php echo $request['request_detail']; ?> <br>
                            <strong>Submitted on:</strong> <?php echo $request['timestamp']; ?> <br>
                            <button class="approve-btn" onclick="approveRequest(<?php echo $request['id']; ?>)">Approve</button>
                            <button class="deny-btn" onclick="denyRequest(<?php echo $request['id']; ?>)">Deny</button>
                        </li>
                    <?php endforeach; ?>
                <?php else: ?>
                    <li>No requests available for approval.</li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</body>

    <div id="content">
        <?php
        // Dynamic content loading based on the page parameter
        switch ($page) {
            case 'users':
                require_once 'users-module/index.php';
                break;
            case 'feedback':
                require_once 'feedback-module/index.php';
                break;
            case 'home':
            default:
                require_once 'main.php';
                break;
        }
        ?>
    </div>

    <script src="js/script.js"></script>
</body>
</html>