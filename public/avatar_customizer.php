<?php include __DIR__ . '/auth/guard.php'; ?>

<?php function renderPage() { ?>

<section>
    <div class="container">
        <div class="avatar-container">
            <img alt="profile picture" src="images/avatars/avatar_<?php echo isset($user_data['profile_picture']) ? $user_data['profile_picture'] : 0 ?>.png">
        </div>
        <div class="avatar-categories-container">
            <button class="category-btn" data-target="skincolor-options">
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
    </div>
</section>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.category-btn');

        buttons.forEach(button => {
            button.addEventListener('click', function() {
                // Remove 'selected' class from all buttons
                buttons.forEach(btn => btn.classList.remove('selected'));
                // Add 'selected' class to the clicked button
                this.classList.add('selected');

                const targetId = this.getAttribute('data-target');
                const targetElement = document.getElementById(targetId);
                // Toggle display
                if (targetElement.style.display === 'none') {
                    // Hide all options containers first
                    document.querySelectorAll('.options-container').forEach(container => {
                        container.style.display = 'none';
                    });
                    // Show the clicked category's options
                    targetElement.style.display = 'flex';
                } else {
                    targetElement.style.display = 'none';
                    this.classList.remove('selected'); // Remove 'selected' class if the category is deselected
                }
            });
        });
    });
</script>

<?php
}

$includeHead = "<link rel='stylesheet' href='/styles/avatar_customizer.css'>";
$documentTitle = 'Profile';
include 'layout/layout.php';
?>
