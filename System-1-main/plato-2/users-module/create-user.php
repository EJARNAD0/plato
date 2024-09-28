<?php
$error = isset($_GET['error']) ? $_GET['error'] : '';
$error_message = '';

switch ($error) {
    case 'password_mismatch':
        $error_message = 'Passwords do not match!';
        break;
    case 'user_not_found':
        $error_message = 'User not found!';
        break;
    case 'creation_failed':
        $error_message = 'User creation failed!';
        break;
}
?>
<h3>Registration</h3>
<p>Complete the form below and press the save button!</p>
<div id="form-block">
    <form method="POST" action="processes/process.user.php?action=new" onsubmit="return validateForm()">
        <div id="form-block-half">
            <label for="fname">First Name</label>
            <input type="text" id="fname" class="input" name="firstname" placeholder="Your name.." required>

            <label for="lname">Last Name</label>
            <input type="text" id="lname" class="input" name="lastname" placeholder="Your last name.." required>

            <label for="access">Access Level</label>
            <select id="access" name="access" required>
                <option value="" disabled selected>Select access level</option>
                <option value="secretary">Secretary</option>
                <option value="admin">Admin</option>
                <option value="superadmin">Super Admin</option>
            </select>
        </div>
        <div id="form-block-half">
            <label for="username">Username</label>
            <input type="text" id="username" class="input" name="username" placeholder="Your username.." required>

            <label for="password">Password</label>
            <input type="password" id="password" class="input" name="password" placeholder="Enter password.." required>

            <label for="confirmpassword">Confirm Password</label>
            <input type="password" id="confirmpassword" class="input" name="confirmpassword" placeholder="Confirm password.." required>
        </div>
        
        <!-- Address Fields -->
        <div id="form-block-half">
            <label for="address">Address</label>
            <input type="text" id="address" class="input" name="address" placeholder="Your address.." required>

            <label for="city">City</label>
            <input type="text" id="city" class="input" name="city" placeholder="Your city.." required>
        </div>
        
        <div id="button-block">
            <input type="submit" value="Save">
        </div>
    </form>
    <p id="error-message" style="color: red;"><?php echo $error_message; ?></p> <!-- Error message area -->
</div>

<script>
function validateForm() {
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirmpassword').value;
    const errorMessage = document.getElementById('error-message');

    if (password !== confirmPassword) {
        errorMessage.textContent = "Passwords do not match!";
        errorMessage.style.display = "block"; // Show error message
        return false; // Prevent form submission
    }

    errorMessage.style.display = "none"; // Hide error message if passwords match
    return true; // Allow form submission
}
</script>
