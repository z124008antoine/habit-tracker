<?php
    session_start();
    if (!isset($_SESSION['user']) || !isset($_SESSION['pfp'])) {
        header('Location: login.php');
        exit();
    }