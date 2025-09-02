<?php

use Core\Database;
use Core\Validator;

$config = require base_path("config.php");
$db = new Database($config['database']);
$error = [];

if (!validator::string($_POST['body'], 1, 1000)) {
    $error['body'] = 'A body of no more than 1,000 characters is required';
}
if (!empty($errors)) {
    return view("notes/create.view.php", [
        'heading' => 'Create Note',
        'errors' => $errors
    ]);
}

$db->query("INSERT INTO `tables`.`notes` (`body`, `user_id`) VALUES (:body, :user_id) ", [
    'body' => $_POST['body'],
    'user_id' => 7
]);

header('location: /notes');
die();
