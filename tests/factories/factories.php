<?php

if (!empty($factory) && !empty($faker)) {
    $factory('Classie\User', [
        'name' => 'Admin',
        'password' => 'password',
        'email' => $faker->email
    ]);

    $factory('Classie\Post', [
        'title' => $faker->sentence,
        'body' => $faker->sentences()
    ]);
}