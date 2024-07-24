<?php
    $dummy_users = [];
    $dummy_users[] = [
        'username' => 'John',
        'password' => 'password',
        'email' => 'john@gmail.com',
        'bio' => 'Hello, I am John. I like to exercise and read.',
        'level' => 2,
        'xp' => 113,
        'avatar_skin_color' => 0,
        'avatar_hair_style' => 0,
        'avatar_hair_color' => 0,
    ];
    $dummy_users[] = [
        'username' => 'Jane',
        'password' => 'password',
        'email' => 'jane@gmail.com',
        'bio' => 'Hello, I am Jane. I like to meditate and write.',
        'level' => 1,
        'xp' => 50,
        'avatar_skin_color' => 0,
        'avatar_hair_style' => 0,
        'avatar_hair_color' => 0,
    ];
    $dummy_users[] = [
        'username'=> 'Jack',
        'password'=> 'password',
        'email'=> 'jack@gmail.com',
        'bio'=> 'Hello, I am Jack. I like to code and cook.',
        'level'=> 3,
        'xp'=> 75,
        'avatar_skin_color' => 0,
        'avatar_hair_style' => 0,
        'avatar_hair_color' => 0,
    ];

    $dummy_habits = [];
    $dummy_habits[] = [
        'user_id' => 1,
        'name' => 'Exercise',
        'description' => 'Go for a run',
        'reward' => 30,
    ];
    $dummy_habits[] = [
        'user_id' => 1,
        'name' => 'Read',
        'description' => 'Read a book',
        'reward' => 20,
    ];
    $dummy_habits[] = [
        'user_id' => 1,
        'name' => 'Drink water',
        'description' => 'Drink 8 glasses of water',
        'reward' => 10,
    ];
    $dummy_habits[] = [
        'user_id' => 1,
        'name' => 'Walk',
        'description' => 'Go for a walk',
        'reward' => 25,
    ];
    $dummy_habits[] = [
        'user_id' => 1,
        'name' => 'Cook',
        'description' => 'Cook a homemade meal',
        'reward' => 22,
    ];
    $dummy_habits[] = [
        'user_id' => 2,
        'name' => 'Meditate',
        'description' => 'Meditate for 10 minutes',
        'reward' => 2,
    ];
    $dummy_habits[] = [
        'user_id' => 3,
        'name' => 'Write',
        'description' => 'Write a blog post',
        'reward' => 2,
    ];
    $dummy_habits[] = [
        'user_id' => 3,
        'name' => 'Code',
        'description' => 'Code for an hour',
        'reward' => 2,
    ];

    $dummy_realizations = [];
    // add one realization for each day since 2023-08-01 with a 50% chance of being completed
    $current_day = new DateTime('2023-08-01');
    $end_day = new DateTime();

    $habit_ids = [1, 2, 3, 4, 5];
    while ($current_day < $end_day) {
        foreach ($habit_ids as $habit_id) {
            if (rand(1,2) <= 1) {
                $dummy_realizations[] = [
                    'habit_id' => $habit_id,
                    'date' => $current_day->format('Y-m-d'),
                ];
            }
        }
        $current_day->modify('+1 day');
    }