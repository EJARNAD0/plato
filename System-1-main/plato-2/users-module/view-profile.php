<h3>System User Profile</h3>
<div class="btn-box">
    <a class="btn-jsactive" onclick="document.getElementById('id03').style.display='block'">
        <i class="fas fa-user-edit"></i> Change Username
    </a> |
    <a class="btn-jsactive" onclick="document.getElementById('id02').style.display='block'">
        <i class="fas fa-lock"></i> Change Password
    </a> |

    <?php if ($user->get_user_status($id) == "1") { ?>
        <a class="btn-jsactive" onclick="document.getElementById('id01').style.display='block'">
            <i class="fas fa-user-slash"></i> Disable Account
        </a>
    <?php } else { ?>
        <a class="btn-jsactive" onclick="document.getElementById('id01').style.display='block'">
            <i class="fas fa-user-check"></i> Activate Account
        </a>
    <?php } ?>
</div>
<br/>
<div id="form-block">
    <form method="POST" action="processes/process.user.php?action=update">
        <?php if ($user->get_user_access($id) != "Secretary") { ?>
        <div id="form-block-half">
            <label for="fname">First Name</label>
            <input type="text" id="fname" class="input" name="firstname" value="<?php echo $user->get_user_firstname($id);?>" placeholder="Your name..">

            <label for="lname">Last Name</label>
            <input type="text" id="lname" class="input" name="lastname" value="<?php echo $user->get_user_lastname($id);?>" placeholder="Your last name..">

            <label for="access">Access Level</label>
            <select id="access" name="access">
                <option value="secretary" <?php if ($user->get_user_access($id) == "Secretary") { echo "selected";};?>>Secretary</option>
                <option value="admin" <?php if ($user->get_user_access($id) == "Admin") { echo "selected";};?>>Admin</option>
                <option value="superadmin" <?php if ($user->get_user_access($id) == "Super Admin") { echo "selected";};?>>Super Admin</option>
            </select>
        </div>
        <?php } ?>

        <div id="form-block-half">
            <label for="status">Account Status</label>
            <select id="status" name="status" disabled>
                <option <?php if ($user->get_user_status($id) == "0") { echo "selected";};?>>Deactivated</option>
                <option <?php if ($user->get_user_status($id) == "1") { echo "selected";};?>>Active</option>
            </select>
            <label for="username">Username</label>
            <input type="username" id="username" class="input" name="username" disabled value="<?php echo $user->get_username($id);?>" placeholder="Your username..">
            <input type="hidden" id="userid" name="userid" value="<?php echo $id;?>"/>
        </div>
        <br/><br/><br/><br/><br/><br/><br/><br/><br/><br/>
        <div id="button-block">
        <input type="submit" value="Update">
        </div>
    </form>
</div>

<div id="id01" class="modal">
  <div id="form-update" class="modal-content">
    <div class="container">
      <h2>Change User Status</h2>
      <p>Are you sure you want to change user status?</p>
      <div class="clearfix">
        <?php
         if($user->get_user_status($id) == "1"){  
         ?>
           <button class="confirmbtn" onclick="disableSubmit()">Confirm</button>
        <?php }else { ?>
           <button class="confirmbtn" onclick="enableSubmit()">Confirm</button>
        <?php }; ?>
        <button class="cancelbtn" onclick="document.getElementById('id01').style.display='none'">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div id="id02" class="modal">
  <div id="form-update" class="modal-content">
    <div class="container">
      <h2>Update User Password</h2>
      <p>Provide required details...</p>
      <form method="POST" id="passwordForm" action="processes/process.user.php?action=updatepassword">
      <input type="hidden" id="userid" name="userid" value="<?php echo $id;?>"/>
        <label for="crpassword">Current Password</label>
        <input type="password" id="crpassword" class="input" name="crpassword" placeholder="Current Password"> 
        <label for="npassword">New Password</label>
        <input type="password" id="npassword" class="input" name="npassword" placeholder="New Password"> 
        <label for="copassword">Confirm Password</label>
        <input type="password" id="copassword" class="input" name="copassword" placeholder="Confirm Password">           
       </form> 
      <div class="clearfix">
        <button class="submitbtn" onclick="passwordSubmit()">Confirm</button>
        <button class="cancelbtn" onclick="document.getElementById('id02').style.display='none'">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div id="id01" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Change User Status</h2>
    </div>
    <div class="modal-body">
      <p>Are you sure you want to change the user status?</p>
      <div class="modal-footer">
        <?php if($user->get_user_status($id) == "1") { ?>
          <button class="confirmbtn" onclick="disableSubmit()">Confirm</button>
        <?php } else { ?>
          <button class="confirmbtn" onclick="enableSubmit()">Confirm</button>
        <?php } ?>
        <button class="cancelbtn" onclick="document.getElementById('id01').style.display='none'">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div id="id02" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Update User Password</h2>
    </div>
    <div class="modal-body">
      <p>Provide required details...</p>
      <form method="POST" id="passwordForm" action="processes/process.user.php?action=updatepassword">
        <input type="hidden" id="userid" name="userid" value="<?php echo $id;?>"/>
        <label for="crpassword">Current Password</label>
        <input type="password" id="crpassword" class="input" name="crpassword" placeholder="Current Password"> 
        <label for="npassword">New Password</label>
        <input type="password" id="npassword" class="input" name="npassword" placeholder="New Password"> 
        <label for="copassword">Confirm Password</label>
        <input type="password" id="copassword" class="input" name="copassword" placeholder="Confirm Password">           
      </form> 
      <div class="modal-footer">
        <button class="submitbtn" onclick="passwordSubmit()">Confirm</button>
        <button class="cancelbtn" onclick="document.getElementById('id02').style.display='none'">Cancel</button>
      </div>
    </div>
  </div>
</div>

<div id="id03" class="modal">
  <div class="modal-content">
    <div class="modal-header">
      <h2>Update Username</h2>
    </div>
    <div class="modal-body">
      <p>Provide required details...</p>
      <form method="POST" id="usernameForm" action="processes/process.user.php?action=updateusername">
        <input type="hidden" id="userid" name="userid" value="<?php echo $id;?>"/>
        <label for="username">Current Username</label>
        <input type="text" id="username" class="input" name="username" placeholder="Current Username"> 
        <label for="crpassword">Current Password</label>
        <input type="password" id="crpassword" class="input" name="crpassword" placeholder="Current Password"> 
        <label for="newusername">New Username</label>
        <input type="text" id="newusername" class="input" name="newusername" placeholder="New Username">           
      </form> 
      <div class="modal-footer">
        <button class="submitbtn" onclick="usernameSubmit()">Confirm</button>
        <button class="cancelbtn" onclick="document.getElementById('id03').style.display='none'">Cancel</button>
      </div>
    </div>
  </div>
</div>

<script>
  // Get the modals
  var modal = document.getElementById('id01');
  var modal_password = document.getElementById('id02');
  var modal_username = document.getElementById('id03');

  // Close modal if user clicks outside of it
  window.onclick = function(event) {
    if (event.target == modal) {
      modal.style.display = "none";
    } else if(event.target == modal_password){
      modal_password.style.display = "none";
    } else if(event.target == modal_username){
      modal_username.style.display = "none";
    }
  }

  function enableSubmit() {
      window.location.href = "processes/process.user.php?action=status&id=<?php echo $id;?>&status=1";
  }
  function disableSubmit() {
      window.location.href = "processes/process.user.php?action=status&id=<?php echo $id;?>&status=0";
  }
  function passwordSubmit() {
    document.getElementById("passwordForm").submit();
  }
  function usernameSubmit() {
    document.getElementById("usernameForm").submit();
  }
</script>
