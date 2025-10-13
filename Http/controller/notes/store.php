<?php

use Core\App;
use Core\Validator;

$db = App::resolve('Core\Database');

$error = [];

if (!Validator::string($_POST['body'], 1, 1000)) {
    $error['body'] = 'A body of no more than 1,000 characters is required';
}
if (!empty($error)) {
    return view("notes/create.view.php", [
        'heading' => 'Create Notes',
        'error' => $error
    ]);
}
$currentUserEmail = $_SESSION['user']['email']['email'];
$currentUserId = $db->query('select (id) from users where email = :email', [
    'email' => $currentUserEmail
])->fetch();

$db->query("INSERT INTO `tables`.`notes` (`body`, `user_id`) VALUES (:body, :user_id) ", [
    'body' => $_POST['body'],
    'user_id' => $currentUserId['id']
]);

header('location: /notes');
die();
