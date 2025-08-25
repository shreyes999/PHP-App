<?php
require 'Validator.php';

$config = require("config.php");
$db = new Database($config['database']);

$heading = "Create Notes";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $error = [];

    if (! validator::string($_POST['body'], 1, 1000)) {
        $error['body'] = 'A body body of no more tahn 1,000 characters is required';
    }

    if (empty($error)) {
        $db->query("INSERT INTO `tables`.`notes` (`body`, `user_id`) VALUES (:body, :user_id) ", [
            'body' => $_POST['body'],
            'user_id' => 7
        ]);
    }
}

require "views/notes/create.view.php";
