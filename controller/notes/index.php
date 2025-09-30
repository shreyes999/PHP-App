<?php

use Core\App;

$db = App::resolve('Core\Database');

$query = "select * from notes where user_id = ? ";
$id = 7;
$notes = $db->query($query, [$id])->fetchAll();

view("notes/index.view.php", [
    'heading' => 'My Notes',
    'notes' => $notes
]);
