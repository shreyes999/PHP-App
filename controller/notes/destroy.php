<?php

use Core\App;

$db = App::resolve('Core\Database');

$currentUserId = 7;

$note = $db->query(
    "select * from notes where id = ?",
    [$_POST['id']]
)->fetch();


authorize($note['user_id'] === $currentUserId);

$db->query("delete from notes where id=:id", [
    'id' => $_POST['id'],
]);

header('Location:/notes');
exit();
