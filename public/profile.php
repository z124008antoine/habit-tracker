<?php include __DIR__ . '/auth/guard.php'; ?>

<?php function renderPage() { ?>

<section>
    <div class="profile">
        <img alt="profile picture" src="images/avatars/avatar_<?php echo isset($_SESSION["pfp"]) ? $_SESSION["pfp"] : 0 ?>.png">
        <div class="profile-info">
            <h2><?php echo $_SESSION['username'] ?></h2>
            <p><?php echo $_SESSION['email'] ?></p>
            <a href="logout.php">Logout</a>
        </div>
    </div>

<?php
}

$includeHead = "<link rel='stylesheet' href='/styles/profile.css'>";
$documentTitle = 'Profile';
include 'layout/layout.php';
?>