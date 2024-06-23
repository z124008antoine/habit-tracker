<?php
    include_once __DIR__ . '/db.php';

    function get_todays_habits($user_id) {
        global $conn;
        $sql = "SELECT habits.id, name, description, reward,
            CASE WHEN realizations.habit_id IS NULL THEN 0 ELSE 1 END AS completed
            FROM habits
            LEFT JOIN realizations
            ON habits.id = realizations.habit_id
            AND realizations.date = CURDATE()
            WHERE user_id = $user_id";
        $result = $conn->query($sql);
        return $result;
    }
    
    if (isset($_GET['complete'])) {
        session_start();
        $habit_id = $_GET['habit_id'];
        $user_id = $_SESSION['user'];
        // check if it is a number to prevent SQL injection
        if (!is_numeric($habit_id)) {
            exit(404);
        }

        $sql = "INSERT INTO realizations (habit_id, date)
            VALUES ((SELECT id FROM habits WHERE id = $habit_id AND user_id = $user_id), CURDATE())"; // make sure the habit belongs to the user
        $conn->query($sql);
        echo json_encode(['success' => true]);
        exit();
    }
