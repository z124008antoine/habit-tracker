<?php
    include_once __DIR__ . '/db.php';

    function search_users($search) {
        global $conn;
        $sql = "SELECT id, username, profile_picture FROM users WHERE username LIKE :search ORDER BY username ASC LIMIT 10";
        $statement = $conn->prepare($sql);
        $statement->execute(['search' => "%$search%"]);
        return $statement->fetchAll();
    }