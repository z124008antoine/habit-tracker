<?php include __DIR__ . '/auth/guard.php'; ?>

<?php function renderPage() { ?>

<section>
    <h1>My Week</h1>
    <div class="week-habits">
        <span></span>
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
                class="year-day<?= $nbCompleted === $maxCompleted ? ' all-completed' : '' ?>"
                style="filter: grayscale(<?= ($maxCompleted - $nbCompleted) / $maxCompleted ?>);"
                title="<?= $currentDay->format('dS F') . ': ' . $nbCompleted . ' completed' ?>"
            ></div>
        <?php
            $currentDay->modify('+1 day');
        }
        ?>
    </div>
    <div class="year-day-legend">
        <p>less</p>
        <div class="year-day" style="align-items:center;filter:grayscale(1);"></div>
        <div class="year-day" style="align-items:center;filter:grayscale(.75);"></div>
        <div class="year-day" style="align-items:center;filter:grayscale(.5);"></div>
        <div class="year-day" style="align-items:center;filter:grayscale(.25);"></div>
        <div class="year-day" style="align-items:center;filter:grayscale(0);"></div>
        <div class="year-day all-completed" style="align-items:center;filter:grayscale(0);"></div>
        <p>more</p>
    </div>
</section>

<?php
}

$includeHead = "<link rel='stylesheet' href='/styles/recap.css'>";
$documentTitle = 'Recap';
include 'layout/layout.php';
?>