<?php include __DIR__ . '/auth/guard.php'; ?>

<?php function renderPage() { ?>

<!-- Retrieve user data from database -->
<?php include __DIR__ . '/database/user.php';
    $user_id = $_GET['user_id'] ?? $_SESSION['user'];
    $user_data = get_user_data($user_id);
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
            <button class="category-btn" data-target="haircolor-options">
                <img src="images/ui/haircolor.png" alt="Hair">
            </button>
        </div>
        <!-- Options Containers -->
        <div id="skincolor-options" class="options-container" style="display: none;">
            <img class="option-img skin-color-option <?php echo $user_data['avatar_skin_color'] == 0 ? 'selected-option' : ''; ?>" data-category="avatar_skin_color" data-value=0 src="images/avatars/0/<?php echo $user_data['avatar_hair_color'] ?>/<?php echo $user_data['avatar_hair_style'] ?>.png" alt="Hair Option 1">
            <img class="option-img skin-color-option <?php echo $user_data['avatar_skin_color'] == 1 ? 'selected-option' : ''; ?>" data-category="avatar_skin_color" data-value=1 src="images/avatars/1/<?php echo $user_data['avatar_hair_color'] ?>/<?php echo $user_data['avatar_hair_style'] ?>.png" alt="Hair Option 2">
            <img class="option-img skin-color-option <?php echo $user_data['avatar_skin_color'] == 2 ? 'selected-option' : ''; ?>" data-category="avatar_skin_color" data-value=2 src="images/avatars/2/<?php echo $user_data['avatar_hair_color'] ?>/<?php echo $user_data['avatar_hair_style'] ?>.png" alt="Hair Option 3">
            <img class="option-img skin-color-option <?php echo $user_data['avatar_skin_color'] == 3 ? 'selected-option' : ''; ?>" data-category="avatar_skin_color" data-value=3 src="images/avatars/3/<?php echo $user_data['avatar_hair_color'] ?>/<?php echo $user_data['avatar_hair_style'] ?>.png" alt="Hair Option 4"> 
        </div>
        <div id="hair-options" class="options-container" style="display: none;">
            <img class="option-img hair-style-option <?php echo $user_data['avatar_hair_style'] == 0 ? 'selected-option' : ''; ?>" data-category="avatar_hair_style" data-value=0 src="images/avatars/<?php echo $user_data['avatar_skin_color'] ?>/<?php echo $user_data['avatar_hair_color'] ?>/0.png" alt="Hair Option 1">
            <img class="option-img hair-style-option <?php echo $user_data['avatar_hair_style'] == 1 ? 'selected-option' : ''; ?>" data-category="avatar_hair_style" data-value=1 src="images/avatars/<?php echo $user_data['avatar_skin_color'] ?>/<?php echo $user_data['avatar_hair_color'] ?>/1.png" alt="Hair Option 2">
            <img class="option-img hair-style-option <?php echo $user_data['avatar_hair_style'] == 2 ? 'selected-option' : ''; ?>" data-category="avatar_hair_style" data-value=2 src="images/avatars/<?php echo $user_data['avatar_skin_color'] ?>/<?php echo $user_data['avatar_hair_color'] ?>/2.png" alt="Hair Option 3">
            <img class="option-img hair-style-option <?php echo $user_data['avatar_hair_style'] == 3 ? 'selected-option' : ''; ?>" data-category="avatar_hair_style" data-value=3 src="images/avatars/<?php echo $user_data['avatar_skin_color'] ?>/<?php echo $user_data['avatar_hair_color'] ?>/3.png" alt="Hair Option 4">
            <img class="option-img hair-style-option <?php echo $user_data['avatar_hair_style'] == 4 ? 'selected-option' : ''; ?>" data-category="avatar_hair_style" data-value=4 src="images/avatars/<?php echo $user_data['avatar_skin_color'] ?>/<?php echo $user_data['avatar_hair_color'] ?>/4.png" alt="Hair Option 5">
            <img class="option-img hair-style-option <?php echo $user_data['avatar_hair_style'] == 5 ? 'selected-option' : ''; ?>" data-category="avatar_hair_style" data-value=5 src="images/avatars/<?php echo $user_data['avatar_skin_color'] ?>/<?php echo $user_data['avatar_hair_color'] ?>/5.png" alt="Hair Option 6">
            <img class="option-img hair-style-option <?php echo $user_data['avatar_hair_style'] == 6 ? 'selected-option' : ''; ?>" data-category="avatar_hair_style" data-value=6 src="images/avatars/<?php echo $user_data['avatar_skin_color'] ?>/<?php echo $user_data['avatar_hair_color'] ?>/6.png" alt="Hair Option 7">
            <img class="option-img hair-style-option <?php echo $user_data['avatar_hair_style'] == 7 ? 'selected-option' : ''; ?>" data-category="avatar_hair_style" data-value=7 src="images/avatars/<?php echo $user_data['avatar_skin_color'] ?>/<?php echo $user_data['avatar_hair_color'] ?>/7.png" alt="Hair Option 8">
            <img class="option-img hair-style-option <?php echo $user_data['avatar_hair_style'] == 8 ? 'selected-option' : ''; ?>" data-category="avatar_hair_style" data-value=8 src="images/avatars/<?php echo $user_data['avatar_skin_color'] ?>/<?php echo $user_data['avatar_hair_color'] ?>/8.png" alt="Hair Option 9">
            <img class="option-img hair-style-option <?php echo $user_data['avatar_hair_style'] == 9 ? 'selected-option' : ''; ?>" data-category="avatar_hair_style" data-value=9 src="images/avatars/<?php echo $user_data['avatar_skin_color'] ?>/<?php echo $user_data['avatar_hair_color'] ?>/9.png" alt="Hair Option 10">
            <img class="option-img hair-style-option <?php echo $user_data['avatar_hair_style'] == 10 ? 'selected-option' : ''; ?>" data-category="avatar_hair_style" data-value=10 src="images/avatars/<?php echo $user_data['avatar_skin_color'] ?>/<?php echo $user_data['avatar_hair_color'] ?>/10.png" alt="Hair Option 11">
            <img class="option-img hair-style-option <?php echo $user_data['avatar_hair_style'] == 11 ? 'selected-option' : ''; ?>" data-category="avatar_hair_style" data-value=11 src="images/avatars/<?php echo $user_data['avatar_skin_color'] ?>/<?php echo $user_data['avatar_hair_color'] ?>/11.png" alt="Hair Option 12">
            <img class="option-img hair-style-option <?php echo $user_data['avatar_hair_style'] == 12 ? 'selected-option' : ''; ?>" data-category="avatar_hair_style" data-value=12 src="images/avatars/<?php echo $user_data['avatar_skin_color'] ?>/<?php echo $user_data['avatar_hair_color'] ?>/11.png" alt="Hair Option 13">
        </div>
        <div id="haircolor-options" class="options-container" style="display: none;">
            <img class="option-img hair-color-option <?php echo $user_data['avatar_hair_color'] == 0 ? 'selected-option' : ''; ?>" data-category="avatar_hair_color" data-value=0 src="images/avatars/<?php echo $user_data['avatar_skin_color'] ?>/0/<?php echo $user_data['avatar_hair_style'] ?>.png" alt="Hair Option 1">
            <img class="option-img hair-color-option <?php echo $user_data['avatar_hair_color'] == 1 ? 'selected-option' : ''; ?>" data-category="avatar_hair_color" data-value=1 src="images/avatars/<?php echo $user_data['avatar_skin_color'] ?>/1/<?php echo $user_data['avatar_hair_style'] ?>.png" alt="Hair Option 2">
            <img class="option-img hair-color-option <?php echo $user_data['avatar_hair_color'] == 2 ? 'selected-option' : ''; ?>" data-category="avatar_hair_color" data-value=2 src="images/avatars/<?php echo $user_data['avatar_skin_color'] ?>/2/<?php echo $user_data['avatar_hair_style'] ?>.png" alt="Hair Option 3">
            <img class="option-img hair-color-option <?php echo $user_data['avatar_hair_color'] == 3 ? 'selected-option' : ''; ?>" data-category="avatar_hair_color" data-value=3 src="images/avatars/<?php echo $user_data['avatar_skin_color'] ?>/3/<?php echo $user_data['avatar_hair_style'] ?>.png" alt="Hair Option 4">
        </div>
        <div class="buttons-container">
            <button class="neon-button-negativ" onclick="window.location.href = '/profile.php';">Cancel</button>
            <button id="confirmSelection" class="neon-button">Confirm</button> <!-- Add onclick event to save the avatar -->
        </div>
    </div>
</section>

<script>

// User data object to store the selected options
const user_data = {
    avatar_skin_color: <?php echo $user_data['avatar_skin_color'] ?>,
    avatar_hair_style: <?php echo $user_data['avatar_hair_style'] ?>,
    avatar_hair_color: <?php echo $user_data['avatar_hair_color'] ?>
};

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

    // Assuming you have images with class 'option-img' and data attributes like 'data-hair-color'
    const optionImages = document.querySelectorAll('.option-img');

    optionImages.forEach(img => {
        img.addEventListener('click', function() {
            // Remove 'selected-option' class from all options in the same category
            const category = this.dataset.category; // Assuming each img has a data-category attribute
            const value = this.dataset.value; // Assuming each img has a data-value attribute

            document.querySelectorAll(`.option-img[data-category="${category}"]`).forEach(img => {
                img.classList.remove('selected-option');
            });

            // Add 'selected-option' class to clicked image
            this.classList.add('selected-option');

            user_data[category] = value;

            updateVisuals(category, value);
        });
    });

    function updateVisuals(category, value) {
        // Update the avatar image based on the selected options
        const avatarImage = document.querySelector('.avatar-container img');
        const newAvatarPath = `images/avatars/${user_data['avatar_skin_color']}/${user_data['avatar_hair_color']}/${user_data['avatar_hair_style']}.png`;
        avatarImage.src = newAvatarPath;

        if(category === 'avatar_hair_style') {
            // Update the hair color options based on the selected hair style
            document.querySelectorAll('.hair-color-option').forEach(img => {
                const hairColor = img.dataset.value; // Assuming each img has a data-hair-color attribute
                img.src = `images/avatars/${user_data['avatar_skin_color']}/${hairColor}/${value}.png`;
            });
            document.querySelectorAll('.skin-color-option').forEach(img => {
                const skinColor = img.dataset.value; // Assuming each img has a data
                img.src = `images/avatars/${skinColor}/${user_data['avatar_hair_color']}/${value}.png`;
            });
        }
        if(category === 'avatar_hair_color') {
            // Update the hair color options based on the selected hair style
            document.querySelectorAll('.hair-style-option').forEach(img => {
                const hairStyle = img.dataset.value; // Assuming each img has a data-hair-color attribute
                img.src = `images/avatars/${user_data['avatar_skin_color']}/${value}/${hairStyle}.png`;
            });
            document.querySelectorAll('.skin-color-option').forEach(img => {
                const skinColor = img.dataset.value; // Assuming each img has a data
                img.src = `images/avatars/${skinColor}/${value}/${user_data['avatar_hair_style']}.png`;
            });
        }
        if(category === 'avatar_skin_color') {
            // Update the hair color options based on the selected hair style
            document.querySelectorAll('.hair-color-option').forEach(img => {
                const hairColor = img.dataset.value; // Assuming each img has a data-hair-color attribute
                img.src = `images/avatars/${value}/${hairColor}/${user_data['avatar_hair_style']}.png`;
            });
            document.querySelectorAll('.hair-style-option').forEach(img => {
                const hairStyle = img.dataset.value; // Assuming each img has a data
                img.src = `images/avatars/${value}/${user_data['avatar_hair_color']}/${hairStyle}.png`;
            });
        }
    }

    function updateSelectionOnServer(category, value) {
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'update_avatar.php', true);
        xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
        xhr.onload = function() {
            if (this.status == 200) {
                console.log(this.responseText);
                // Assuming the server sends back a success message or status in the response
                const response = JSON.parse(this.responseText);
                if (response.success) {
                    // Redirect to profile.php if the update was successful
                    window.location.href = 'profile.php';
                } else {
                    // Handle error or unsuccessful update
                    console.error('Update failed:', response.message);
                }
            }
        };

        // Convert user_data object to URL-encoded string
        const userDataEntries = Object.entries(user_data).map(([key, value]) => {
            return `${encodeURIComponent(key)}=${encodeURIComponent(value)}`;
        });
        const userDataString = userDataEntries.join('&');

        xhr.send(userDataString);
    }

    document.getElementById('confirmSelection').addEventListener('click', function() {
    // Iterate over user_data to update each selection on the server
    for (const [category, value] of Object.entries(user_data)) {
        updateSelectionOnServer(category, value);
    }
});
});
</script>

<?php
}

$includeHead = "<link rel='stylesheet' href='/styles/avatar_customizer.css'>";
$documentTitle = 'Profile';
include 'layout/layout.php';
?>
