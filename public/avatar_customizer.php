<?php include __DIR__ . '/auth/guard.php'; ?>

<?php function renderPage() { ?>

<!-- Retrieve user data from database -->
<?php include __DIR__ . '/database/user.php';
    $user_id = $_GET['user_id'] ?? $_SESSION['user'];
    $profile_picture = get_user_profile_picture_path($user_id);
?>

<section>
    <div class="container">
        <div class="avatar-container">
            <img alt="profile picture" src=<?php echo $profile_picture ?>>
        </div>
        <div class="avatar-categories-container">
            <button class="category-btn selected" data-target="skincolor-options">
                <img src="images/ui/skincolor.png" alt="skincolor">
            </button>    
            <button class="category-btn" data-target="hair-options">
                <img src="images/ui/haircut.png" alt="Hair">
            </button>
        </div>
        <!-- Options Containers -->
        <div id="skincolor-options" class="options-container" style="display: none;">
            <img class="option-img" src="images/avatars/avatar_0.png" alt="Hair Option 1">
            <img class="option-img" src="images/avatars/avatar_0.png" alt="Hair Option 2">
            <img class="option-img" src="images/avatars/avatar_0.png" alt="Hair Option 3">
            <img class="option-img" src="images/avatars/avatar_0.png" alt="Hair Option 4">
            <img class="option-img" src="images/avatars/avatar_0.png" alt="Hair Option 5">
            <!-- Hair options go here -->
        </div>
        <div id="hair-options" class="options-container" style="display: none;">
            <img class="option-img" src="images/avatars/avatar_0.png" alt="Hair Option 1">
            <img class="option-img" src="images/avatars/avatar_0.png" alt="Hair Option 2">
            <!-- Hair options go here -->
        </div>
        <div class="buttons-container">
            <button class="neon-button-negativ" onclick="window.location.href = '/profile.php';">Cancel</button>
            <button class="neon-button">Confirm</button> <!-- Add onclick event to save the avatar -->
        </div>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const buttons = document.querySelectorAll('.category-btn');
    let defaultSelected = false;

    buttons.forEach(button => {
        if (button.classList.contains('selected')) {
            const targetId = button.getAttribute('data-target');
            const targetElement = document.getElementById(targetId);
            targetElement.style.display = 'flex';
            defaultSelected = true;
        }

        button.addEventListener('click', function() {
            if (this.classList.contains('selected')) {
                return;
            }

            buttons.forEach(btn => btn.classList.remove('selected'));
            this.classList.add('selected');

            const targetId = this.getAttribute('data-target');
            const targetElement = document.getElementById(targetId);
            document.querySelectorAll('.options-container').forEach(container => {
                container.style.display = 'none';
            });
            targetElement.style.display = 'flex';
        });
    });

    // If no button is marked as selected by default, select the skin color category programmatically
    if (!defaultSelected) {
        // Assuming the skin color button has an id or can be uniquely selected
        const skinColorButton = document.querySelector('.skin-color-btn'); // Update selector as needed
        skinColorButton.classList.add('selected');
        const targetId = skinColorButton.getAttribute('data-target');
        const targetElement = document.getElementById(targetId);
        targetElement.style.display = 'flex';
    }
});
</script>

<?php
}

$includeHead = "<link rel='stylesheet' href='/styles/avatar_customizer.css'>";
$documentTitle = 'Profile';
include 'layout/layout.php';
?>
