<?php
 if($user == 'Staff' && $user_id_login != $id){
    header("location: index.php?page=users&subpage=users");
 }
?>
<h3>Registration</h3>
<p>Complete the form below and press the save button!</p>
<div id="form-block">
    <form method="POST" action="processes/process.user.php?action=new">
        <div id="form-block-half">
            <label for="fname">First Name</label>
            <input type="text" id="fname" class="input" name="firstname" value="<?php echo $user->get_user_firstname($id);?>" placeholder="Your name..">

            <label for="lname">Last Name</label>
            <input type="text" id="lname" class="input" name="lastname" placeholder="Your last name..">

            <label for="access">Access Level</label>
            <select id="access" name="access">
              <option value="staff">Staff</option>
              <option value="supervisor">Supervisor</option>
              <option value="Manager">Manager</option>
            </select>
        </div>
        <div id="form-block-half">
            <label for="username">Username</label>
            <input type="username" id="username" class="input" name="username" placeholder="Your username..">

            <label for="password">Password</label>
            <input type="password" id="password" class="input" name="password" placeholder="Enter password..">

            <label for="confirmpassword">Confirm Password</label>
            <input type="password" id="confirmpassword" class="input" name="confirmpassword" placeholder="Confirm password..">
            
        </div>
        <div id="button-block">
        <input  type="submit" value="Save">
        </div>
  </form>
</div>
