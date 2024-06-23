<?php
    include __DIR__ ."../../env.php";
    global $conn;
    $conn = new mysqli(getenv('DB_HOST'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_NAME'));
    if ($conn->connect_error) {
        die('Failed to connect to the database: ' . $conn->connect_error);
    }
