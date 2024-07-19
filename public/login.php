<?php
    session_start();
    if (isset($_SESSION["user"]) && isset($_SESSION["pfp"]))
    {
        header("Location: /");
        exit();
    }

    include 'database/db.php';
    if (isset($_POST["mail"]) && isset($_POST["password"]))
    {
        $statement = $conn->prepare("SELECT id, password, profile_picture, username, bio FROM users WHERE email = ?");
        $statement->execute([$_POST["mail"]]);
        $user = $statement->fetch();
        
        if (password_verify($_POST["password"], $user["password"])) {
            $_SESSION["user"] = $user["id"];
            $_SESSION["pfp"] = $user["profile_picture"];
            header("Location: /");
            exit();
        } else {
            $error = "Invalid email or password";
        }
    }
?>

<?php function renderPage() { ?>

<form method="post" action="#">
    <label for="mail">Email</label>
    <input class="text-input" type="email" name="mail" id="mail" required>
    <label for="password">Password</label>
    <input class="text-input" type="password" name="password" id="password" required>
    <ul class="login-register-ul">
        <button type="submit" class="neon-button">Login</button>
        <?php if (isset($error)) { ?>
        <p><?= $error ?></p>
        <?php } ?>
        <a class="neon-button" href="/registration_form.php">Register</a>
    </ul>
</form>
<?php
}

$documentTitle = 'Login'; // Set the title of the document for the layout
$includeHead = '<link rel="stylesheet" href="/styles/login.css">'; // Include the CSS for the page
include 'layout/layout_no_nav.php';
?>