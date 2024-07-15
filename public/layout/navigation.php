<nav>
    <ul>
        <li><a class="page-link" href="/">My habits</a></li>
        <li><a class="page-link" href="recap.php">Recap</a></li>
        <li><a class="page-link" href="profiles.php">Profiles</a></li>
        <li>
            <a href="profile.php" class="profile">
                <img alt="profile picture" src="images/avatars/avatar_<?php echo $_SESSION["pfp"] ?? 0 ?>.png">
            </a>
        </li>
    </ul>
    <?php
    include __DIR__ . '/../components/pixel_mask.php';
    pixel_mask(20, 'nav-mask');
    ?>
</nav>
<?php include __DIR__ . '/../components/hamburger.php'; ?>
