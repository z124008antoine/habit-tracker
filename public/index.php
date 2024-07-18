<?php include __DIR__ . '/auth/guard.php'; ?>

<?php function renderPage() { ?>

<h1>My habits</h1>

<li style="display: flex; flex-wrap: wrap;">
    <div class="create-habit">
        <button class="neon-button" style="margin:0.5em;" onclick="window.location.href = '/create_habit_form.php';"> +
            Create</button>
    </div>
    <div class="modify-habit">
        <button class="neon-button" style="margin:0.5em;" onclick="window.location.href = '/modify_habit_form.php';"> ~
            Modify</button>
    </div>
    <div class="delete-habit">
        <button class="neon-button-negativ" style="margin:0.5em;"
            onclick="window.location.href = '/delete_habit_form.php';"> -
            Delete</button>
    </div>
</li>

<?php
    include __DIR__ . '/database/habits.php';
    $habits = get_todays_habits($_SESSION['user']);
    foreach ($habits as $key => $value) {
?>
<div class="habit<?= $value["completed"] ? " completed" : "" ?>">
    <div class="habit-title">
        <h2><?= $value["name"] ?></h2>
        <p><?= $value["description"] ?></p>
    </div>
    <p class="reward"><?= $value["reward"] ?>xp</p>
    <button class="neon-button" <?= $value["completed"] ? "disabled" : "" ?>
        onclick="completeHabit(this, <?= $value["id"] ?>)">
        DONE
    </button>
</div>

<?php } ?>
<div class="xp-bar">
    <?php
        include_once __DIR__ . '/components/progress_bar.php';
        renderBar(50, 100, "habit-xp");
    ?>
    <script src="/scripts/progress_bar.js"></script>
</div>

<script>
function start_party(el) {
    party.sparkles(el, {
        lifetime: party.variation.range(0.5, 0.8),
        count: party.variation.range(100, 150),
        size: party.variation.range(1, 1),
        rotation: new party.Vector(0, 0, 0),
        color: [party.Color.fromHex('#0ee4e4'), party.Color.fromHex('#eb0565'), party.Color.fromHex('#bc11cc')],
        shapes: ['square'],
    });
}

function completeHabit(el, id) {
    el.disabled = true;

    fetch('/database/habits.php?complete=1&habit_id=' + id, {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
            },
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                start_party(el);
                el.classList.add('completed');
            } else {
                el.disabled = false;
            }
        });
}
</script>

<?php
}

$documentTitle = 'Home'; // Set the title of the document for the layout
$includeHead = '<link rel="stylesheet" href="/styles/home.css">'; // Include the CSS for the page
include 'layout/layout.php';
?>