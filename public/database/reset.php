<?php
    // WARNING: This file is meant for development purposes only. It will reset the database and remove all data.
    // Do not use this file in production.
    include __DIR__ . '/db.php';

    try {
        $conn->query("DROP TABLE realizations");
    }
    catch (Exception $e) {
        echo "Error removing realizations table<br>";
    }
    try {
        $conn->query("DROP TABLE habits");
    }
    catch (Exception $e) {
        echo "Error removing habits table<br>";
    }
    try {
        $conn->query("DROP TABLE users");
    }
    catch (Exception $e) {
        echo "Error removing users table<br>";
    }

    echo "<br>Done.";
