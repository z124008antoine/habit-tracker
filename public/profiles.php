<?php include __DIR__ . '/auth/guard.php'; ?>

<?php function renderPage() { ?>
    
<h1>Search people</h1>
<input type="text" class="text-input" placeholder="Search">

<div class="results">
    <?php
    include __DIR__ . '/database/users.php';
    $users = search_users('');
    foreach ($users as $user) {
        ?>
        <div class="result">
            <a href="/profile.php?user_id=<?= $user['id'] ?>">
                <img class="profile-pic" src="/images/avatars/avatar_<?= $user['profile_picture'] ?>.png" alt="<?= $user['username'] ?>">
                <?= $user['username'] ?>
            </a>
        </div>
    <?php
    }
    ?>
</div>

<?php
}

$documentTitle = 'Profiles'; // Set the title of the document for the layout
$includeHead = '<link rel="stylesheet" href="/styles/profiles.css">'; // Include the CSS for the page
include 'layout/layout.php';
?>