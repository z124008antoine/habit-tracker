<?php
    include __DIR__ ."../../env.php";
    global $conn;
    // $conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'));
    try {
        $conn = new PDO("mysql:host=".getenv('DB_HOST').";dbname=".getenv('DB_NAME'), getenv('DB_USER'), getenv('DB_PASS'));
    } catch (PDOException $e) {
        echo "Connection failed: " . $e->getMessage();
        exit(1);
    }