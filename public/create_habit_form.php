<?php include __DIR__ . '/auth/guard.php'; ?>

<?php function renderPage() { ?>

<h2 class="form-title">Create a new Habit</h2>

<form method="POST" action="database\habits.php">
    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']; ?>">
    <input type="hidden" name="private" value="<?php echo 0; ?>">
    <label for="habit_name">Habit Name:</label>
    <input class="text-input" type="text" id="habit_name" name="habit_name" required
        placeholder="go grocery shopping"><br><br>
    <label for="habit_description">Habit Description:</label>
    <input class="text-input" type="text" id="habit_description" name="habit_description" required
        placeholder="buy: 1x tomato, 1x potato"><br><br>
    <label for="habit_reward">Habit Reward:</label>
    <input class="text-input" type="number" id="habit_reward" name="habit_reward" required min="1" step="1"
        placeholder=2><br><br>
    <input type="submit" class="neon-button" name="create_habit" value="Create">
</form>
<div class="center">
    <button class="neon-button-negativ" onclick="window.location.href = '/index.php';">Cancel</button>
</div>

<?php
}

$documentTitle = 'Create_Habit_Form'; // Set the title of the document for the layout
$includeHead = '<link rel="stylesheet" href="/styles/registration.css">'; // Include the CSS for the page
include 'layout/layout.php';
?>