<?php

use Core\App;

$db = App::resolve('Core\Database');

$query = "select * from notes where user_id = ? ";
$currentUserEmail = $_SESSION['user']['email']['email'];
$currentUserId = $db->query('select (id) from users where email = :email', [
    'email' => $currentUserEmail
])->fetch();

$notes = $db->query($query, [$currentUserId['id']])->fetchAll();

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);
