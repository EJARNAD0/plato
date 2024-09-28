<?php
include_once 'config/config.php';
include_once 'classes/class.user.php';

$user = new User();
if ($user->get_session()) {
    header("location: index.php");
}

if (isset($_REQUEST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $login = $user->check_login($username, $password);
    if ($login) {
        header("location: index.php");
    } else {
        $error_message = "Incorrect username or password. Please try again.";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div id="login-block">
        <form method="POST" action="">
            <div class="login-box">
                <p>Login</p>
                <?php if (isset($error_message)) { ?>
                    <div class="error-notif">
                        <span><?php echo $error_message; ?></span>
                    </div>
                <?php } ?>
                <div class="user-box">
                    <input type="text" name="username" required autocomplete="off">
                    <label>Username</label>
                </div>
                <div class="user-box">
                    <input type="password" name="password" required>
                    <label>Password</label>
                </div>
                <input type="submit" name="submit" value="Login">
            </div>
        </form>
    </div>
</body>
</html>