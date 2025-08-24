<?php

$config = require("config.php");
$db = new Database($config['database']);

$heading = "Create Notes";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = [];
    if (strlen($_POST['body']) == 0) {
        $error['body'] = 'A body is required';
    }
    if (strlen($_POST['body']) > 1000) {
        $error['body'] = 'The body can not be more than 1,000 characters';
    }
    if (empty($error)) {
        $db->query("INSERT INTO `tables`.`notes` (`body`, `user_id`) VALUES (:body, :user_id) ", [
            'body' => $_POST['body'],
            'user_id' => 7
        ]);
    }
}

require "views/note-create.view.php";
