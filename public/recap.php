<?php include __DIR__ . '/auth/guard.php'; ?>

<?php function renderPage() { ?>

<h1>My Week</h1>
<div class="habits">

    <h2>Day</h2>
    <div class="days">
        <span class="day-title">M</span>
        <span class="day-title">T</span>
        <span class="day-title">W</span>
        <span class="day-title">T</span>
        <span class="day-title">F</span>
        <span class="day-title">S</span>
        <span class="day-title">S</span>
    </div>
<?php
    include __DIR__ . '/database/habits.php';
    $habits = get_weeks_habits($_SESSION['user']);
    foreach ($habits as $habit) {
?>

    <h2><?= $habit['name'] ?></h2>
    <div class="days">
        <?php foreach ($habit['completed'] as $completed) { ?>
            <div class="day <?= $completed ? 'completed' : '' ?>"></div>
        <?php } ?>
    </div>

<?php } ?>
</div>

<?php
}

$includeHead = "<link rel='stylesheet' href='/styles/recap.css'>";
$documentTitle = 'Recap';
include 'layout/layout.php';
?>