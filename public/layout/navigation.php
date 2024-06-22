<nav>
    <ul>
        <li><a class="page-link" href="/">My habits</a></li>
        <li><a class="page-link" href="dashboard.php">Dashboard</a></li>
        <li><a class="page-link" href="profiles.php">Profiles</a></li>
        <li>
            <a href="profile.php" class="profile">
                <img alt="profile picture" src="images/avatars/avatar_<?php echo isset($_SESSION["pfp"]) ? $_SESSION["pfp"] : 0 ?>.png">
            </a>
        </li>
    </ul>
</nav>