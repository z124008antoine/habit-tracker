<?php include __DIR__ . '/auth/guard.php'; ?>

<?php function renderPage() { ?>

<!-- Retrieve user data from database -->
<?php include __DIR__ . '/database/user.php'; 
    $user_id = $_GET['user_id'];
    $user_data = get_user_data($user_id);
?>

<section>
    <div class="container">
        <div class="left-column">
            <!-- Content for the left column -->
            <div class="avatar">
                <img alt="profile picture"
                    src="images/avatars/avatar_<?php echo isset($user_data['profile_picture']) ? $user_data['profile_picture'] : 0 ?>.png">
            </div>
            <h2 class="username" id="username-display"><?php echo $user_data['username'] ?></h2>
            <form id="edit-profile-form" action="update_profile.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $user_data['username']; ?>">
                <label for="bio">Bio:</label>
                <textarea class="large-text-input" id="bio" name="bio"><?php echo $user_data['bio']; ?></textarea>
                <div id="bio-char-count">0 / 3000 characters</div>
            </form>
        </div>
        <div class="right-column">
            <!-- Content for the right column -->
            <div class="bio">
                <h4>Bio</h4>
                <p id="bio-display"><?php echo $user_data['bio'] ?></p>
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
                    <div class="year-day<?= $nbCompleted === $maxCompleted ? ' all-completed' : '' ?>"
                        style="filter: grayscale(<?= ($maxCompleted - $nbCompleted) / $maxCompleted ?>);"
                        title="<?= $currentDay->format('dS F') . ': ' . $nbCompleted . ' completed' ?>"></div>
                    <?php
                        $currentDay->modify('+1 day');
                    }
                    ?>
                </div>
            </div>

        </div>
    </div>
</section>
<?php
}

$includeHead = "<link rel='stylesheet' href='/styles/profile.css'>";
$documentTitle = 'Profile_User_Search';
include 'layout/layout.php';
?>