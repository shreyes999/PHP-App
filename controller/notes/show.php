<?php

use Core\App;

$db = App::resolve('Core\Database');

$currentUserEmail = $_SESSION['user']['email']['email'];
$currentUserId = $db->query('select (id) from users where email = :email', [
    'email' => $currentUserEmail
])->fetch();

$note = $db->query(
    "select * from notes where id = ?",
    [$_GET['id']]
)->fetch();

authorize($note['user_id'] === $currentUserId['id']);

require view("notes/show.view.php", [
    'heading' => 'Note',
    'note' => $note
]);
