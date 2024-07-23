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
		$lastRealizations = get_last_realizations($_SESSION['user']);
		$today = new DateTime();
		$nbDaysWeek = $today->diff(new DateTime('next sunday'))->days;
        foreach ($lastRealizations as $habit) {
            ?>
        <h2><?= $habit['name'] ?></h2>
        <?php for ($i = 0; $i < $nbDaysWeek; $i++) { ?>
            <div class="week-day <?= $habit['completed'][30-$nbDaysWeek+$i] ? 'completed' : '' ?>"></div>
        <?php } ?>

		<?php for ($i = 7; $i > $nbDaysWeek; $i--) { ?>
			<div class="week-day" style="background-color: var(--color-2);"></div>
		<?php } ?>
    
    <?php } ?>
    </div>
</section>

<section>
    <h1>My Month</h1>
    <canvas id="month-chart" width="70" height="20"></canvas>
</section>

<script>
    const ctx = document.getElementById('month-chart');
	const realizations = <?= json_encode($lastRealizations) ?>;

    document.addEventListener('DOMContentLoaded', () => {
		const dailyCompletions = new Array(30).fill(0);
		for (const key in realizations) {
			for (let i = 0; i < 30; i++) {
				dailyCompletions[i] += realizations[key].completed[i];
			}
		}
		const colors = getComputedStyle(document.documentElement);
		const lineColor = colors.getPropertyValue('--color-1');
		const textColor = colors.getPropertyValue('--color-2');

		Chart.defaults.font.family = 'Pixeloid';
		new Chart(ctx, {
			type: 'line',
			data: {
				labels: Array.from({length: 30}, (_, i) => i + 1),
				datasets: [{
					data: dailyCompletions,
					borderColor: lineColor,
					backgroundColor: lineColor,
					fill: false
				}]
			},
			options: {
				scales: {
					y: {
						beginAtZero: true
					}
				},
				plugins: {
					legend: {
						display: false
					}
				}
			}
		});
	});
</script>

<?php
}

$includeHead = "<link rel='stylesheet' href='/styles/recap.css'><script src='https://cdn.jsdelivr.net/npm/chart.js' defer></script>";
$documentTitle = 'Recap';
include 'layout/layout.php';
?>