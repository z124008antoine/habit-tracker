<?php include __DIR__ . '/auth/guard.php'; ?>
<?php include __DIR__ . '/database/habits.php'; ?>

<?php function renderPage() { ?>

<h2>Delete Habits</h2>

<form method="POST" action="database/habits.php">

    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']; ?>">

    <?php $allhabits = get_all_habits($_SESSION['user']);
    foreach ($allhabits as $habit) { ?>
    <label for="habit_<?php echo $habit['id']; ?>">
        <input type="checkbox" id="habit_<?php echo $habit['id']; ?>" name="habits[]"
            value="<?php echo $habit['id']; ?>">
        <?php echo $habit['name']; ?>
    </label><br>
    <?php } ?>

    <br>
    <input type="submit" class="neon-button" name="delete_habits" value="Delete">
</form>

<div style="text-align: center;">
    <button class="neon-button" onclick="window.location.href = '/index.php';">Cancel</button>
</div>

<?php
}

$documentTitle = 'Delete_Habit_Form'; 
$includeHead = '<link rel="stylesheet" href="/styles/registration.css">'; 
include 'layout/layout.php';
?>