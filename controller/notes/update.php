<?php

use Core\App;
use Core\Validator;

$db = App::resolve('Core\Database');

$currentUserEmail = $_SESSION['user']['email']['email'];
$currentUserId = $db->query('select (id) from users where email = :email', [
    'email' => $currentUserEmail
])->fetch();

$note = $db->query(
    "select * from notes where id = ?",
    [$_POST['id']]
)->fetch();

authorize($note['user_id'] === $currentUserId['id']);

$error = [];
if (!Validator::string($_POST['body'], 1, 1000)) {
    $error['body'] = 'A body of no more than 1,000 characters is required';
}
if (count($error)) {
    return view("notes/edit.view.php", [
        'heading' => 'Edit Notes',
        'error' => $error,
        'note' => $note
    ]);
}

$db->query("update notes set body = :body where id = :id", [
    'id' => $_POST['id'],
    'body' => $_POST['body']
]);

header('location:/notes');
die();
