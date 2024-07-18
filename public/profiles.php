<?php include __DIR__ . '/auth/guard.php'; ?>
<?php include __DIR__ . '/database/users.php'; ?>

<?php function renderPage() { ?>

<div class="center">


    <h1 class="form-title">Following</h1>

    <ul class="following-results">
        <?php
        $followingUsers = get_following_users($_SESSION['user']);
        foreach ($followingUsers as $user) {
        ?>
        <li class="following">
            <a href="/profile.php?user_id=<?= $user['id'] ?>">
                <img class="profile-pic" src="/images/avatars/avatar_<?= $user['profile_picture'] ?>.png"
                    alt="<?= $user['username'] ?>">
                <br>
                <?= $user['username'] ?>
            </a>
        </li>
        <?php
        }
        ?>
    </ul>

    <div class="divider"></div>

    <h1 class="form-title">Search people</h1>

    <form method=" GET">
        <input type="text" class="text-input" name="search" placeholder="Search">
        <button class="neon-button" type="submit">Search</button>
    </form>

    <div class="results">
        <?php
    $search = isset($_GET['search']) ? $_GET['search'] : '';
    if (!empty($search)) {
        $users = search_users($search, $_SESSION['user']);
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
</div>
<?php
}

$documentTitle = 'Profiles'; // Set the title of the document for the layout
$includeHead = '<link rel="stylesheet" href="/styles/profiles.css">'; // Include the CSS for the page
include 'layout/layout.php';