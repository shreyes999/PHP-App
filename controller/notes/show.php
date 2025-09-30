<?php

use Core\App;

$db = App::resolve('Core\Database');

$currentUserId = 7;

$note = $db->query(
    "select * from notes where id = ?",
    [$_GET['id']]
)->fetch();

authorize($note['user_id'] === $currentUserId);

require view("notes/show.view.php", [
    'heading' => 'Note',
    'note' => $note
]);
