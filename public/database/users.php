<?php
    include_once __DIR__ . '/db.php';

    function search_users($search, $current_user) {
        global $conn;
        $sql = "SELECT id, username, profile_picture FROM users WHERE username LIKE :search AND id != :current_user ORDER BY username ASC LIMIT 10";
        $statement = $conn->prepare($sql);
        $statement->execute(['search' => "%$search%", 'current_user' => $current_user]);
        return $statement->fetchAll();
    }

    function get_following_users($current_user) {
        global $conn;
        $sql = "SELECT users.id, users.username, users.profile_picture 
                FROM users 
                INNER JOIN user_follows ON users.id = user_follows.followed_id 
                WHERE user_follows.follower_id = :current_user";
        $statement = $conn->prepare($sql);
        $statement->execute(['current_user' => $current_user]);
        return $statement->fetchAll();
    }

    function check_follow($current_user, $user_to_check) {
        // returns true if count > 0, current user follows user to check
        // Otherwise, it returns false.
        global $conn;
        $query =
            "SELECT COUNT(*) FROM user_follows WHERE follower_id = :current_user AND followed_id = :user_to_check";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':current_user', $current_user);
        $stmt->bindParam(':user_to_check', $user_to_check);
        $stmt->execute();
        $count = $stmt->fetchColumn();
        return $count > 0;
    } 
    
    if (isset($_POST['follow'])) {
        $current_user = $_POST['current_user'];
        $user_to_follow = $_POST['user_to_follow'];

        // Check if the current user is already following the user to follow
        $query = "SELECT COUNT(*) FROM user_follows WHERE follower_id = :current_user AND followed_id = :user_to_follow";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':current_user', $current_user);
        $stmt->bindParam(':user_to_follow', $user_to_follow);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count > 0) {
            header("Location: /profile.php?user_id=$user_to_follow ");
            echo "You are already following this user.";
            exit();
        } else {
            // Follow the user
            $query = "INSERT INTO user_follows (follower_id, followed_id) VALUES (:current_user, :user_to_follow)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':current_user', $current_user);
            $stmt->bindParam(':user_to_follow', $user_to_follow);

            if ($stmt->execute()) {
                header("Location: /profile.php?user_id=$user_to_follow ");
                echo "You are now following this user.";
                exit();
            } else {
                echo "ERROR: Failed to follow user.";
            }
        }
    }

    if (isset($_POST['unfollow'])) {
        $current_user = $_POST['current_user'];
        $user_to_follow = $_POST['user_to_follow'];

        // Check if the current user is actually following the user to follow
        $query = "SELECT COUNT(*) FROM user_follows WHERE follower_id = :current_user AND followed_id = :user_to_follow";
        $stmt = $conn->prepare($query);
        $stmt->bindParam(':current_user', $current_user);
        $stmt->bindParam(':user_to_follow', $user_to_follow);
        $stmt->execute();
        $count = $stmt->fetchColumn();

        if ($count < 1) {
            header("Location: /profile.php?user_id=$user_to_follow ");
            echo "You are not even following this user.";
            exit();
        } else {
            $query = "DELETE FROM user_follows WHERE follower_id = :current_user AND followed_id = :user_to_follow";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':current_user', $current_user);
            $stmt->bindParam(':user_to_follow', $user_to_follow);

            if ($stmt->execute()) {
                header("Location: /profile.php?user_id=$user_to_follow ");
                echo "You are now unfollowing this user.";
                exit();
            } else {
                echo "ERROR: Failed to unfollow user.";
            }  
        }
    }
    
    ?>