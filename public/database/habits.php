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
        $statement = $conn->prepare($sql);
        $statement->execute();
        return $statement->fetchAll();
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

    // returns an array of habits with the following structure:
    // ['id' => [
    //     'name' => string,
    //     'completed' => [0, 1, 0, 0, 0, 0, 0] // 0 for not completed, 1 for completed for each day of the week
    // ]]
    function get_weeks_habits($user_id) {
        global $conn;

        $startOfWeek = new DateTime('monday this week');
        $startOfWeekStr = $startOfWeek->format('Y-m-d');

        $sql = "SELECT habits.id, name, date,
            CASE WHEN realizations.habit_id IS NULL THEN 0 ELSE 1 END AS completed
            FROM habits
            LEFT JOIN realizations
            ON habits.id = realizations.habit_id
            AND realizations.date >= '$startOfWeekStr'
            WHERE user_id = $user_id";

        $statement = $conn->prepare($sql);
        $statement->execute();
        $res = $statement->fetchAll();
        $habits = [];
        // set completed to false for each day of the week
        foreach ($res as $habit) {
            if (!isset($habits[$habit['id']])) {
                $habits[$habit['id']] = [
                    'name' => $habit['name'],
                    'completed' => [0, 0, 0, 0, 0, 0, 0]
                ];
            }
            if (!is_null($habit['date'])) {
                $date = new DateTime($habit['date']);
                $day = $date->format('N') - 1;
                $habits[$habit['id']]['completed'][$day] = $habit['completed'];
            }
        }

        return $habits;
    }

    // returns an array of habits with the following structure:
    // [int, int, ...] where each int is the number of completions for each day since the beggining of the year
    function get_year_habits($user_id) {
        global $conn;
        $startDay = new DateTime('first day of january');
        $startDayStr = $startDay->format('Y-m-d');

        $sql = 'SELECT realizations.date, COUNT(*) AS completions
            FROM habits
            JOIN realizations
            ON habits.id = realizations.habit_id
            WHERE user_id = ?
            AND realizations.date >= ?
            GROUP BY realizations.date
            ORDER BY realizations.date';

        $statement = $conn->prepare($sql);
        $statement->execute([$user_id, $startDayStr]);
        $res = $statement->fetchAll();
        $habits = [];

        $today = new DateTime();
        $todayNb = $today->format('z');
        for ($i = 0; $i < $todayNb; $i++) {
            $habits[$i] = 0;
        }

        foreach ($res as $habit) {
            $date = new DateTime($habit['date']);
            $day = $date->format('z');
            $habits[$day] = $habit['completions'];
        }
        return $habits;
    }