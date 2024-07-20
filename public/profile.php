<?php include __DIR__ . '/auth/guard.php'; ?>

<?php function renderPage() { ?>

<!-- Retrieve user data from database -->
<?php include __DIR__ . '/database/user.php';
    $user_id = $_GET['user_id'] ?? $_SESSION['user'];
    $user_data = get_user_data($user_id);
?>

<section>
    <div class="container">
        <div class="left-column">
            <!-- Content for the left column -->
            <div class="avatar">
                <img alt="profile picture" src="images/avatars/avatar_<?php echo isset($user_data['profile_picture']) ? $user_data['profile_picture'] : 0 ?>.png">
            </div>
            <h2 class="username" id="username-display"><?php echo $user_data['username'] ?></h2>
            <?php
            include __DIR__ . '/database/users.php';
            // Check if the user follows the visited user profile
            $follows = check_follow($_SESSION['user'], $user_id);
            
            include __DIR__ . '/components/progress_bar.php';
            renderBar($user_data['xp'], 100 + $user_data['level'] * 20, "profile-xp");
            ?>
            <form id="edit-profile-form" action="update_profile.php" method="post">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?php echo $user_data['username']; ?>">
                <label for="bio">Bio:</label>
                <textarea class="large-text-input" id="bio" name="bio"><?php echo $user_data['bio']; ?></textarea>
                <div id="bio-char-count">0 / 3000 characters</div>
            </form>
            <?php if ($_SESSION['user'] == $user_id) { ?>
                <button class="profile-edit-button" id="edit-profile-button">Edit Profile</button>
                <div id="edit-profile-form-buttons">
                    <button id="cancel-btn">Cancel</button>
                    <button id="save-btn">Save</button>
                </div>
                <button class="profile-edit-button" onclick="window.location.href = '/logout.php';">Logout</button>
            <?php } else if ($follows) { ?>
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
                <!-- <button class="bio-edit-button"></button> -->
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
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editProfileButton = document.getElementById('edit-profile-button');
        if (!editProfileButton)
            return; // skip if the button is not found (aka not on the user's own profile)
        const usernameDisplay = document.getElementById('username-display');
        const bioDisplay = document.getElementById('bio-display');
        const editForm = document.getElementById('edit-profile-form');
        const saveButton = document.getElementById('save-btn');
        const cancelButton = document.getElementById('cancel-btn');
        const formButtons = document.getElementById('edit-profile-form-buttons');
        const bioTextarea = document.getElementById('bio');
        
        // Initialize the character count on page load
        updateCharacterCount();

        // Function to update character count
        function updateCharacterCount() {
            var charCountDisplay = document.getElementById('bio-char-count');
            var currentLength = bioTextarea.value.length;
            if(currentLength > 3000){
                bioTextarea.value = bioTextarea.value.substring(0, 3000);
                currentLength = bioTextarea.value.length;
            }
            charCountDisplay.textContent = `${currentLength} / 3000 characters`;
        }

        bioTextarea.addEventListener('input', updateCharacterCount);

        editProfileButton.addEventListener('click', () => {
            //usernameDisplay.style.display = 'none';
            editForm.style.display = 'flex';
            editProfileButton.style.display = 'none';
            formButtons.style.display = 'flex';
            updateCharacterCount();
        });

        cancelButton.addEventListener('click', () => {
            //usernameDisplay.style.display = 'block';
            editForm.style.display = 'none';
            editProfileButton.style.display = 'block';
            formButtons.style.display = 'none';
            editForm.reset();
        });

        saveButton.addEventListener('click', () => {
            editForm.submit();
        });
    });
    
</script>
<?php
}

$includeHead = "<link rel='stylesheet' href='/styles/profile.css'>";
$documentTitle = 'Profile';
include 'layout/layout.php';
?>
