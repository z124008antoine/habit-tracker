<?php include __DIR__ . '/auth/guard.php'; ?>

<?php function renderPage() { ?>

<section>
    <h1>My Week</h1>
    <div class="week-habits">
        <h2>Day</h2>
        <span class="week-day-title">M</span>
        <span class="week-day-title">T</span>
        <span class="week-day-title">W</span>
        <span class="week-day-title">T</span>
        <span class="week-day-title">F</span>
        <span class="week-day-title">S</span>
        <span class="week-day-title">S</span>
    <?php
        include __DIR__ . '/database/habits.php';
        $weekHabits = get_weeks_habits($_SESSION['user']);
        foreach ($weekHabits as $habit) {
            ?>
    
        <h2><?= $habit['name'] ?></h2>
        <?php foreach ($habit['completed'] as $completed) { ?>
            <div class="week-day <?= $completed ? 'completed' : '' ?>"></div>
        <?php } ?>
    
    <?php } ?>
    </div>
</section>

<section>
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
        $yearHabits = get_year_habits($_SESSION['user']);
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
                class="year-day"
                style="filter: grayscale(<?= ($maxCompleted - $nbCompleted + 1) / ($maxCompleted + 1) ?>);"
                title="<?= $currentDay->format('dS F') ?>"
            ></div>
        <?php
            $currentDay->modify('+1 day');
        }
        ?>
    </div>
</section>

<?php
}

$includeHead = "<link rel='stylesheet' href='/styles/recap.css'>";
$documentTitle = 'Recap';
include 'layout/layout.php';
?>