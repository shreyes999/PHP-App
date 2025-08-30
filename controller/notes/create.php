<?php

use Core\Database;
use Core\Validator;


$config = require base_path("config.php");
$db = new Database($config['database']);
$error = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {


    if (!validator::string($_POST['body'], 1, 1000)) {
        $error['body'] = 'A body of no more than 1,000 characters is required';
    }

    if (empty($error)) {
        $db->query("INSERT INTO `tables`.`notes` (`body`, `user_id`) VALUES (:body, :user_id) ", [
            'body' => $_POST['body'],
            'user_id' => 7
        ]);
    }
}

require view("notes/create.view.php", [
    'heading' => 'Create Notes',
    'error' => $error
]);
