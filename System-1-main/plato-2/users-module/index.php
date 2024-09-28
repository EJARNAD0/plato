<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users Module</title>
</head>
<body>
<div id="third-submenu">
    <!-- Menu items available for all users -->
    <a href="index.php?page=settings" id="list-users-link"><i class="fa fa-list"></i> List Users</a> | 
    <a href="index.php?page=settings&action=create" id="new-user-link"><i class="fa fa-plus-circle"></i> New User</a> | 
    <br><br>
    <div id="search-container">
        Search <input type="text" id="search" name="search" onkeyup="showResults(this.value)" placeholder="Search users...">
        <div id="search-result"></div>
    </div>
</div>

<div id="subcontent">
    <?php
    // Handle different actions based on the query string
    switch ($action) {
        case 'create':
            require_once 'create-user.php'; // Page for creating a new user
            break;
        case 'profile':
            require_once 'view-profile.php'; // Page to view user profile
            break;
        case 'result':
            require_once 'search.php'; // Page to display search results
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
