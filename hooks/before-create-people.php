<?php

use Core\Database;
use Core\Validation;

Validation::run([
    'email' => [
        'required','unique:people'
    ]
], $data);

$db = new Database();
$user = $db->insert('users', [
    'name' => $data['name'],
    'username' => $data['email'],
    'password' => md5('password')
]);

$data['user_id'] = $user->id;

