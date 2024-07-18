<?php include __DIR__ . '/auth/guard.php'; ?>
<?php include __DIR__ . '/database/users.php'; ?>

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
            <?php
            // Check if the user follows the visited user profile
            $follows = check_follow($_SESSION['user'], $user_id);
            ?>

            <?php if ($follows) { ?>
            <form method="POST" action="database/users.php">
                <input type="hidden" name="current_user" value="<?php echo $_SESSION['user']; ?>">
                <input type="hidden" name="user_to_follow" value="<?php echo $user_id; ?>">
                <input type="submit" class="unfollow-button" name="unfollow" value=" - Unfollow">
            </form>
            <?php } else { ?>
            <form method="POST" action="database/users.php">
                <input type="hidden" name="current_user" value="<?php echo $_SESSION['user']; ?>">
                <input type="hidden" name="user_to_follow" value="<?php echo $user_id; ?>">
                <input type="submit" class="follow-button" name="follow" value=" + Follow">
            </form>
            <?php } ?>
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
                    $yearHabits = get_year_habits($user_id);
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