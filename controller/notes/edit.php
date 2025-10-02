<?php

use Core\App;
use Core\validator;

$db = App::resolve('Core\Database');

$currentUserId = 7;

$note = $db->query(
    "select * from notes where id = ?",
    [$_GET['id']]
)->fetch();

authorize($note['user_id'] === $currentUserId);

// if (!validator::string($_PATCH['body'], 1, 1000)) {
//     $error['body'] = 'A body of no more than 1,000 characters is required';
// }
// if (!empty($error)) {
//     return view("notes/create.view.php", [
//         'heading' => 'Create Notes',
//         'error' => $error
//     ]);
// }


return view("notes/edit.view.php", [
    'heading' => 'Edit Notes',
    'note' => $note
]);
