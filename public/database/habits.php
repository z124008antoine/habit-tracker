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

    function get_all_habits($user_id) {
        global $conn;
        $sql = "SELECT id, name FROM habits WHERE user_id = $user_id";
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


    # Create a new habit
    if (isset($_POST['create_habit'])) {
        $user_id = $_POST['user_id'];
        $private = $_POST['private'];
        $habit_name = $_POST['habit_name'];
        $habit_description = $_POST['habit_description'];
        $habit_reward = $_POST['habit_reward'];

        // Insert habit into the database
        $query = "INSERT INTO habits (user_id, private, name, description, reward) VALUES (:user_id, :private, :habit_name, :habit_description, :habit_reward)";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':private', $private);
        $stmt->bindParam(':habit_name', $habit_name);
        $stmt->bindParam(':habit_description', $habit_description);
        $stmt->bindParam(':habit_reward', $habit_reward);

        if ($stmt->execute()) {
            header("Location: /index.php");
            exit();
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    }

    #delete habit
    if (isset($_POST['delete_habits'])) {
        $selectedHabits = $_POST['habits'];
        foreach ($selectedHabits as $habit_id) {
            $sql = "DELETE FROM habits WHERE id = $habit_id";
            $conn->query($sql);
        }
        header("Location: /index.php");
        exit();
    }

    #modify habit
    if (isset($_POST['modify_habits'])) {
        $user_id = $_POST['user_id'];
        $habit_id = $_POST['habit_id'];
        $habit_name = $_POST['habit_name'];
        $habit_description = $_POST['habit_description'];
        $habit_reward = $_POST['habit_reward'];
    
        // Update habit in the database
        $query = "UPDATE habits SET name = :habit_name, description = :habit_description, reward = :habit_reward WHERE id = :habit_id AND user_id = :user_id";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':user_id', $user_id);
        $stmt->bindParam(':habit_id', $habit_id);
        $stmt->bindParam(':habit_name', $habit_name);
        $stmt->bindParam(':habit_description', $habit_description);
        $stmt->bindParam(':habit_reward', $habit_reward);
    
        if ($stmt->execute()) {
            header("Location: /index.php");
            exit();
        } else {
            echo "Error: " . $stmt->errorInfo()[2];
        }
    }