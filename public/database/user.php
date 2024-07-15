<?php
    include_once __DIR__ . '/db.php';

    function get_user_data($user_id) {
        global $conn;
        $sql = "SELECT id, username, profile_picture, bio FROM users WHERE id = :id";
        $statement = $conn->prepare($sql);
        $statement->execute(['id' => $user_id]);
        return $statement->fetch();
    }