<?php
    include __DIR__ . "/db.php";

    // check if the database is empty
    $res = $conn->query("SHOW TABLES");
    // if not empty
    if ($res->num_rows > 0) {
        die("Database is not empty");
    }

    $users = "CREATE TABLE users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(30) NOT NULL,
        email VARCHAR(50) NOT NULL,
        profile_picture INT(6) DEFAULT 0,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

    $habits = "CREATE TABLE habits (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        user_id INT(6) UNSIGNED NOT NULL,
        private BOOLEAN DEFAULT FALSE,
        name VARCHAR(30) NOT NULL,
        description VARCHAR(100),
        frequency INT(6) NOT NULL,
        reward INT(6) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
    )";

    $conn->query($users);
    $conn->query($habits);

    include './dummies.php'; // include the dummies records
    
    foreach ($dummy_users as $user) {
        $hashed = password_hash($user['password'], PASSWORD_DEFAULT);
        $conn->query("INSERT INTO users (username, email, password)
            VALUES ('{$user['username']}', '{$user['email']}', '{$hashed}')");
    }

    foreach ($dummy_habits as $habit) {
        $conn->query("INSERT INTO habits (user_id, name, description, frequency, reward)
            VALUES ('{$habit['user_id']}', '{$habit['name']}', '{$habit['description']}', '{$habit['frequency']}', '{$habit['reward']}')");
    }

    echo "Tables created successfully.";