<?php

use Core\App;

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

$db->query("delete from notes where id=:id", [
    'id' => $_POST['id'],
]);

header('Location:/notes');
exit();
