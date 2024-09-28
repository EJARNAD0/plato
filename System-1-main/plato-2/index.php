<?php
/* include the class file (global - within application) */
include_once 'classes/class.user.php';
include_once 'classes/class.feedback.php';
include_once 'classes/class.request.php';
include 'config/config.php';

$page = (isset($_GET['page']) && $_GET['page'] != '') ? $_GET['page'] : '';
$subpage = (isset($_GET['subpage']) && $_GET['subpage'] != '') ? $_GET['subpage'] : '';
$action = (isset($_GET['action']) && $_GET['action'] != '') ? $_GET['action'] : '';
$id = (isset($_GET['id']) && $_GET['id'] != '') ? $_GET['id'] : '';

// Instantiate User class and check session
$user = new User();
$feedback = new Feedback();
$request = new Request();
if(!$user->get_session()){
    header("location: login.php");
}
$user_id = $user->get_user_id($_SESSION['username']);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <title>Plato Admin Dashboard</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css?<?php echo time();?>">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" integrity="sha512-SzlrxWUlpfuzQ+pcUCosxcglQRNAq/DZjVsC0lE40xsADsfeQoEypE+enwcOiGjk/bSuGGKHEyjSoQ1zVisanQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600&display=swap" rel="stylesheet">
</head>
<body>
    <div id="container">
        <header>
            <h1>Plato Admin Dashboard</h1>
        </header>
        <nav>
            <ul class="menu"> 
                <li><a class="active" href="index.php"><i class="fa-solid fa-house-chimney"></i> Home</a></li>
                <li><a href="index.php?page=feedback"><i class="fa-brands fa-product-hunt"></i> Feedback</a></li>
                <li><a href="index.php?page=transaction"><i class="fa-solid fa-hand-holding-dollar"></i> Logs</a></li>
                <li><a href="index.php?page=request"><i class="fa-sharp fa-solid fa-warehouse"></i> Approval of Request</a></li>
                <li><a href="index.php?page=maps"><i class="fa-solid fa-map-marked"></i> Maps</a></li>
                <li><a href="index.php?page=settings"><i class="fa-solid fa-gear"></i> Settings</a></li>
                <li><a href="logout.php" class="logout"><i class="fa-solid fa-right-from-bracket"></i> Log Out</a></li>
            </ul>
        </nav>
        <main>
            <?php
            switch($page){
                case 'settings':
                    require_once 'users-module/index.php';
                    break; 
                case 'feedback':
                    require_once 'feedback-module/index.php';
                    break; 
                case 'request':
                    require_once 'request-module/index.php';
                    break; 
                case 'maps':
                    require_once 'maps-module/index.php';
                    break; 
                default:
                    require_once 'main.php';
                    break; 
            }
            ?>
        </main>
    </div>
</body>
<script src="script.js"></script>
</html>
