<?php include __DIR__ . '/auth/guard.php'; ?>

<?php function renderPage() { ?>

<section>
    <div class="grid-container">
        <div class="profile">
            <div class="avatar">
                <img alt="profile picture" src="images/avatars/avatar_<?php echo isset($_SESSION["pfp"]) ? $_SESSION["pfp"] : 0 ?>.png">
            </div>
            <div class="username"><?php echo $_SESSION['username'] ?></div>
            <!-- <a href="edit-profile.php" class="edit-profile">Edit profile</a> -->
            <button class="profile-edit-button">Edit Profile</button>
            <button class="profile-edit-button" onclick="window.location.href = '/logout.php';">Logout</button>

        </div>
        <div class="bio">
            <h4>Bio</h4>
            <p><?php echo $_SESSION['bio'] ?></p>
            <button class="bio-edit-button"></button>
        </div>
        <div class="activity">
            <?php include __DIR__ . '/database/habits.php'; ?>
            <h1>My Year</h1>
            <div class="year-days">
                <span class="year-day-title">M</span>
                <span class="year-day-title">T</span>
                <span class="year-day-title">W</span>
                <span class="year-day-title">T</span>
                <span class="year-day-title">F</span>
                <span class="year-day-title">S</span>
                <span class="year-day-title">S</span>
                <?php
                $yearHabits = get_year_habits($_SESSION['user']);
                $maxCompleted = 0;
                foreach ($yearHabits as $nbCompleted) {
                    if ($nbCompleted > $maxCompleted) {
                        $maxCompleted = $nbCompleted;
                    }
                }
                
                $currentDay = new DateTime('first day of january');
                foreach ($yearHabits as $nbCompleted) {
                    ?>
                    <div
                        class="year-day<?= $nbCompleted === $maxCompleted ? ' all-completed' : '' ?>"
                    style="filter: grayscale(<?= ($maxCompleted - $nbCompleted) / $maxCompleted ?>);"
                        title="<?= $currentDay->format('dS F') . ': ' . $nbCompleted . ' completed' ?>"
                    ></div>
                <?php
                    $currentDay->modify('+1 day');
                }
                ?>
            </div>
        </div>
    </div>
</section>

<?php
}

$includeHead = "<link rel='stylesheet' href='/styles/profile.css'>";
$documentTitle = 'Profile';
include 'layout/layout.php';
?>
