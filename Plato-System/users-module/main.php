<div id="search-result">
  <h3>System Users</h3>
  <div id="subcontent">
    <?php if ($user->get_user_access($user_id) == "Manager" || $user->get_user_access($user_id) == "Supervisor") { ?>
    <table id="data-list">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Access Level</th>
        <th>Username</th>
      </tr>
      <?php
      $count = 1;
      if ($user->list_users() != false) {
        foreach ($user->list_users() as $value) {
          extract($value);
      ?>
            <tr>
              <td><?php echo $count; ?></td>
              <td><a href="index.php?page=settings&subpage=users&action=profile&id=<?php echo $user_id; ?>"><?php echo $user_lastname . ', ' . $user_firstname; ?></a></td>
              <td><?php echo $user_access; ?></td>
              <td><?php echo $username; ?></td>
            </tr>
      <?php
          $count++;
        }
      } else {
        echo "No Record Found.";
      }
      ?>
    </table>
    <?php } else { ?>
    <table id="data-list">
      <tr>
        <th>#</th>
        <th>Name</th>
        <th>Access Level</th>
        <th>Username</th>
      </tr>
      <?php
      $count = 1;
      // List only the current user if they are not a manager
      $current_user = $user->get_user_by_id($user_id);
      if ($current_user != false) {
        extract($current_user);
      ?>
        <tr>
          <td><?php echo $count; ?></td>
          <td><a href="index.php?page=settings&subpage=users&action=profile&id=<?php echo $user_id; ?>"><?php echo $user_lastname . ', ' . $user_firstname; ?></a></td>
          <td><?php echo $user_access; ?></td>
          <td><?php echo $username; ?></td>
        </tr>
      <?php
      } else {
        echo "No Record Found.";
      }
      ?>
    </table>
    <?php } ?>
  </div>
</div>