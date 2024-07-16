<?php function renderPage() { ?>

<h2 class="form-title">Registration</h2>

<form method="POST" action="register.php" onsubmit="return validateForm()">
    <label for="username">Username:</label>
    <input class="text-input" type="text" id="username" name="username" required placeholder="abc"><br><br>
    <label for="email">Email:</label>
    <input class="text-input" type="text" id="email" name="email" required placeholder="abc@mail.com"><br><br>
    <label for="password">Password:</label>
    <input class="text-input" type="password" id="password" name="password" required><br><br>
    <input type="submit" class="neon-button" name="register" value="Register">
</form>
<p>Already have an account? <a href="login.php">Login here</a></p>

<script>
window.onload = function() {
    document.getElementById('username').value = '';
    document.getElementById('email').value = '';
    document
        .getElementById('password').value = '';
};

function validateForm() {
    var username = document.getElementById("username").value;
    var email = document.getElementById("email").value;
    var password = document.getElementById("password").value;

    if (username === "" || email === "" || password === "") {
        alert("Please fill in all fields.");
        return false;
    }
    return true;
}
</script>

<?php
}

$documentTitle = 'Registration'; // Set the title of the document for the layout
$includeHead = '<link rel="stylesheet" href="/styles/registration.css">'; // Include the CSS for the page
include 'layout/layout_no_nav.php';
?>