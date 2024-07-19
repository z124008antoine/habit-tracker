<?php include __DIR__ . '/auth/guard.php'; ?>
<?php include __DIR__ . '/database/habits.php'; ?>

<?php function renderPage() { ?>

<h2 class="form-title">Delete Habits</h2>

<form method="POST" action="database/habits.php">

    <input type="hidden" name="user_id" value="<?php echo $_SESSION['user']; ?>">

    <ul class="center">
        <?php $allhabits = get_all_habits($_SESSION['user']);
        foreach ($allhabits as $habit) { ?>
        <li><label for="habit_<?php echo $habit['id']; ?>">
                <input type="checkbox" id="habit_<?php echo $habit['id']; ?>" name="habits[]"
                    value="<?php echo $habit['id']; ?>">
                <?php echo $habit['name']; ?>
            </label></li>
        <?php } ?>
    </ul>

    <br>
    <input type="submit" class="neon-button" name="delete_habits" value="Delete">
</form>

<div class="center-text">
    <button class="neon-button-negativ" onclick="window.location.href = '/index.php';">Cancel</button>
</div>

<?php
}

$documentTitle = 'Delete_Habit_Form'; 
$includeHead = '<link rel="stylesheet" href="/styles/registration.css">'; 
include 'layout/layout.php';
?>