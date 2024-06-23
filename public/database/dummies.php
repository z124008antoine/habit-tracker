<?php
    $dummy_users = [];
    $dummy_users[] = [
        'username' => 'John',
        'password' => 'password',
        'email' => 'john@gmail.com',
    ];
    $dummy_users[] = [
        'username' => 'Jane',
        'password' => 'password',
        'email' => 'jane@gmail.com',
    ];
    $dummy_users[] = [
        'username'=> 'Jack',
        'password'=> 'password',
        'email'=> 'jack@gmail.com',
    ];

    $dummy_habits = [];
    $dummy_habits[] = [
        'user_id' => 1,
        'name' => 'Exercise',
        'description' => 'Go for a run',
        'frequency' => 3,
        'reward' => 5,
    ];
    $dummy_habits[] = [
        'user_id' => 1,
        'name' => 'Read',
        'description' => 'Read a book',
        'frequency' => 2,
        'reward' => 3,
    ];
    $dummy_habits[] = [
        'user_id' => 2,
        'name' => 'Meditate',
        'description' => 'Meditate for 10 minutes',
        'frequency' => 1,
        'reward' => 2,
    ];
    $dummy_habits[] = [
        'user_id' => 3,
        'name' => 'Write',
        'description' => 'Write a blog post',
        'frequency' => 1,
        'reward' => 2,
    ];
    $dummy_habits[] = [
        'user_id' => 3,
        'name' => 'Code',
        'description' => 'Code for an hour',
        'frequency' => 1,
        'reward' => 2,
    ];

    $dummy_realizations = [];
    $dummy_realizations[] = [
        "habit_id" => 1,
        "date" => "2024-06-20",
    ];
    $dummy_realizations[] = [
        "habit_id" => 1,
        "date" => "2024-06-21",
    ];
    $dummy_realizations[] = [
        "habit_id" => 1,
        "date" => "2024-06-23",
    ];
    $dummy_realizations[] = [
        "habit_id" => 2,
        "date" => "2024-06-20",
    ];