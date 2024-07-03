<?php
    include __DIR__ . "/db.php";

    // check if the database is empty
    $statement = $conn->prepare("SHOW TABLES");
    $statement->execute();
    $result = $statement->fetch();
    if ($result) {
        echo "Tables already exist.";
        die();
    }

    $users = "CREATE TABLE users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        profile_picture INT(6) DEFAULT 0,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
        UNIQUE (email)
    )";

    $habits = "CREATE TABLE habits (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(6) UNSIGNED NOT NULL,
        private BOOLEAN DEFAULT FALSE,
        name VARCHAR(30) NOT NULL,
        description VARCHAR(100),
        reward INT(6) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
        INDEX (user_id)
    )";

    $realizations = "CREATE TABLE realizations (
        habit_id INT(6) UNSIGNED NOT NULL,
        date DATE NOT NULL,
        FOREIGN KEY (habit_id) REFERENCES habits(id) ON DELETE CASCADE,
        PRIMARY KEY (habit_id, date)
    )";

    $conn->query($users);
    $conn->query($habits);
    $conn->query($realizations);

    include __DIR__ . '/dummies.php'; // include the dummies records
    
    foreach ($dummy_users as $user) {
        $hashed = password_hash($user['password'], PASSWORD_DEFAULT);
        $conn->query("INSERT INTO users (username, email, password, profile_picture)
            VALUES ('{$user['username']}', '{$user['email']}', '{$hashed}', '{$user['profile_picture']}')");
    }

    foreach ($dummy_habits as $habit) {
        $conn->query("INSERT INTO habits (user_id, name, description, reward)
            VALUES ('{$habit['user_id']}', '{$habit['name']}', '{$habit['description']}', '{$habit['reward']}')");
    }

    foreach ($dummy_realizations as $realization) {
        $conn->query("INSERT INTO realizations (habit_id, date)
            VALUES ('{$realization['habit_id']}', '{$realization['date']}')");
    }

    echo "Tables created successfully.";