<?php
    // WARNING: This file is meant for development purposes only. It will reset the database and remove all data.
    // Do not use this file in production.
    include './db.php';

    $conn->query("DROP TABLE habits");
    $conn->query("DROP TABLE users");
