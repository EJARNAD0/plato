<div id="search-result">
  <h3>System Users</h3>
  <div id="subcontent">
    <table id="data-list">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Access Level</th>
        <th>Username</th>
        <th>Address</th>
        <th>City</th>
      </tr>
      <?php
    $count = 1;
    // Fetch and display all users, regardless of access level
    if ($user->list_users() != false) {
        foreach ($user->list_users() as $value) {
            // Ensure variables are set before using them
            $user_firstname = $value['user_firstname'] ?? 'N/A';
            $user_lastname = $value['user_lastname'] ?? 'N/A';
            $user_access = $value['user_access'] ?? 'N/A';
            $username = $value['username'] ?? 'N/A';
            $address = $value['user_address'] ?? 'N/A';  // Set to 'N/A' if undefined
            $city = $value['user_city'] ?? 'N/A';        // Set to 'N/A' if undefined
            $user_id = $value['user_id']; // Assume user_id always exists
    ?>
            <tr>
                <td><?php echo $count; ?></td>
                <td><a href="index.php?page=settings&action=profile&id=<?php echo $user_id; ?>"><?php echo $user_firstname . ' ' . $user_lastname; ?></a></td>
                <td><?php echo $user_access; ?></td>
                <td><?php echo $username; ?></td>
                <td><?php echo $address; ?></td>
                <td><?php echo $city; ?></td>
            </tr>
    <?php
            $count++;
        }
    } else {
        echo "No Record Found.";
    }
    ?>
    
    </table>
  </div>
</div>
