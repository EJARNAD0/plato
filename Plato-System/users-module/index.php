<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Module</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
<div id="third-submenu">
    <?php
    // Check the user access and display menu items accordingly
    if ($user->get_user_access($user_id) != "Staff" && $id != $user_id) {
        ?>
        <a href="index.php?page=users&subpage=users" id="list-users-link"><i class="fa fa-list"></i> List Users</a> | 
        <a href="index.php?page=users&subpage=users&action=create" id="new-user-link"><i class="fa fa-plus-circle"></i> New User</a> | 
        <a href="index.php"><i class="fa fa-dashboard"></i> Dashboard</a> 
        <br><br>
        <div id="search-container">
            Search <input type="text" id="search" name="search" onkeyup="showResults(this.value)" placeholder="Search users...">
            <div id="search-result"></div>
        </div>
        <?php
    }
    ?> 
</div>

<div id="subcontent">
    <?php
    // Handle different actions based on the query string
    switch ($action) {
        case 'create':
            if ($user->get_user_access($user_id) == "Manager" || $user->get_user_access($user_id) == "Supervisor") {
                require_once 'create-user.php'; // Page for creating a new user
            } else {
                header("location: index.php?page=users&subpage=users");
            }
            break;
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
            require_once 'main.php'; // This should be the file that lists all users
            break;
    }
    ?>
</div>

<!-- Script for handling search -->
<script>
function showResults(str) {
  if (str.length == 0) {
    document.getElementById("search-result").innerHTML = "";
    return;
  } else {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
      if (this.readyState == 4 && this.status == 200) {
        document.getElementById("search-result").innerHTML = this.responseText;
      }
    };
    xmlhttp.open("GET", "search.php?q=" + str, true);
    xmlhttp.send();
  }
}

// Hide search bar when "New User" is clicked
function hideSearchBar() {
    document.getElementById('search-container').style.display = 'none';
}

// Automatically hide search bar if the page is on the "create" action
window.onload = function() {
    const urlParams = new URLSearchParams(window.location.search);
    const action = urlParams.get('action');
    if (action === 'create') {
        hideSearchBar();
    }
};
</script>

</body>
</html>
