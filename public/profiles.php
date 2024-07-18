<?php include __DIR__ . '/auth/guard.php'; ?>

<?php function renderPage() { ?>

<h1>Search people</h1>
<form method="GET">
    <input type="text" class="text-input" name="search" placeholder="Search">
    <button class="neon-button" type="submit">Search</button>
</form>

<div class="results">
    <?php
    include __DIR__ . '/database/users.php';
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    if (!empty($search)) {
        $users = search_users($search);
        foreach ($users as $user) {
            ?>
    <div class="result">
        <a href="/profile.php?user_id=<?= $user['id'] ?>">
            <img class="profile-pic" src="/images/avatars/avatar_<?= $user['profile_picture'] ?>.png"
                alt="<?= $user['username'] ?>">
            <?= $user['username'] ?>
        </a>
    </div>
    <?php
        }
    }
    ?>
</div>

<?php
}

$documentTitle = 'Profiles'; // Set the title of the document for the layout
$includeHead = '<link rel="stylesheet" href="/styles/profiles.css">'; // Include the CSS for the page
include 'layout/layout.php';