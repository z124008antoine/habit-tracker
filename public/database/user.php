<?php
    include_once __DIR__ . '/db.php';

    function get_user_data($user_id) {
        global $conn;
        $sql = "SELECT id, username, bio, level, xp, avatar_skin_color, avatar_hair_style, avatar_hair_color FROM users WHERE id = :id";
        $statement = $conn->prepare($sql);
        $statement->execute(['id' => $user_id]);
        return $statement->fetch();
    }

    function get_user_profile_picture_path($user_id) {
        $user_data = get_user_data($user_id);
        return "images/avatars/" . $user_data['avatar_skin_color'] . "/" . $user_data['avatar_hair_color'] . "/" . $user_data['avatar_hair_style'] . ".png";
    }

    function add_user_xp($user_id, $val_query = "0") {
        global $conn;
        $query = "SELECT level, xp, $val_query as val FROM users WHERE id = :id";

        $statement = $conn->prepare($query);
        $statement->execute(['id' => $user_id]);
        $user = $statement->fetch();

        $xp = $user['xp'];
        $xp += $user['val'];
        $level = $user['level'];
        $xp_needed = 100 + $level * 20;
        $progress = [];
        while ($xp >= $xp_needed) {
            $xp -= $xp_needed;
            $level++;
            $xp_needed += 20;
            $progress[] = $xp_needed;
        }

        $sql = "UPDATE users SET xp = :xp, level = :level WHERE id = :id";
        $statement = $conn->prepare($sql);
        $statement->execute(['xp' => $xp, 'level' => $level, 'id' => $user_id]);

        return [
            'final' => $xp,
            'progress' => $progress
        ];
    }