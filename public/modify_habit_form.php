<?php include __DIR__ . '/auth/guard.php'; ?>
<?php include __DIR__ . '/database/habits.php'; ?>

<?php function renderPage() { ?>

<h2 class="form-title">Modify Habit</h2>

<form method="POST" action="database/habits.php">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']; ?>">

    <ul class="center">
        <?php $allhabits = get_all_habits($_SESSION['user']);
    foreach ($allhabits as $habit) { ?>
        <li><label for="habit_<?php echo $habit['id']; ?>" data-habitinfo='<?= json_encode($habit); ?>'>
                <input type="radio" id="habit_<?php echo $habit['id']; ?>" name="habit_id"
                    value="<?php echo $habit['id']; ?>">
                <?php echo $habit['name']; ?>
            </label></li>
        <?php } ?>
    </ul>

    <br>
    <label for="habit_name">New Habit Name:</label>
    <input class="text-input" type="text" id="habit_name" name="habit_name" required
        placeholder="go grocery shopping"><br><br>
    <label for="habit_description">New Habit Description:</label>
    <textarea class="textarea-input" type="text" id="habit_description" name="habit_description" required
        placeholder="buy: 1x tomato, 1x potato"></textarea><br><br>
    <label for="habit_reward">New Habit Reward:</label>
    <input class="text-input" type="number" id="habit_reward" name="habit_reward" required min="1" max="30" step="1"
        placeholder=2><br><br>
    <input type="submit" class="neon-button" name="modify_habits" value="Modify">
</form>
<div class="center-text">
    <button class="neon-button-negativ" onclick="window.location.href = '/index.php';">Cancel</button>
</div>

<script>
    const habitRadios = document.querySelectorAll('input[type="radio"]');
    habitRadios.forEach(radio => {
        radio.addEventListener('change', () => {
            if (!radio.checked)
                return;
            const habitInfo = JSON.parse(radio.parentElement.getAttribute('data-habitinfo'));
            document.getElementById('habit_name').value = habitInfo.name;
            document.getElementById('habit_description').value = habitInfo.description;
            document.getElementById('habit_reward').value = habitInfo.reward;
        });
    });
</script>

<?php
}

$documentTitle = 'Modify_Habit_Form'; // Set the title of the document for the layout
$includeHead = '<link rel="stylesheet" href="/styles/registration.css">'; // Include the CSS for the page
include 'layout/layout.php';