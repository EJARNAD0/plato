<?php
require_once '../classes/class.user.php';

$users = new User();

// Get the search query from the URL parameter
$q = isset($_GET['q']) ? trim($_GET['q']) : '';
$count = 1;

if (!empty($q)) {
  // Perform the search query and generate the search results table
  $data = $users->list_users_search($q);

  if (!empty($data)) {
    $hint = '<h3>Search Result(s)</h3>';
    $hint .= '<table id="data-list">';
    $hint .= '<tr>
                <th>#</th>
                <th>Name</th>
                <th>Access Level</th>
                <th>Username</th>
              </tr>';

    foreach ($data as $user) {
      $hint .= '<tr>';
      $hint .= '<td>' . $count . '</td>';
      $hint .= '<td><a href="index.php?page=settings&subpage=users&action=profile&id=' . $user['user_id'] . '">' . $user['user_lastname'] . ', ' . $user['user_firstname'] . '</a></td>';
      $hint .= '<td>' . $user['user_access'] . '</td>';
      $hint .= '<td>' . $user['username'] . '</td>';
      $hint .= '</tr>';

      $count++;
    }

    $hint .= '</table>';
  } else {
    // If no results are found, display a message
    $hint = '<p>No results found.</p>';
  }
} else {
  // If no search query is provided, display a message
  $hint = '<p>Please enter a search query.</p>';
}

echo $hint;
?>