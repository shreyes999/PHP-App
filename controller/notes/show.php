<?php

use Core\Database;

$config = require base_path("config.php");

$db = new Database($config['database']);


$currentUserId = 7;

$note = $db->query("select * from notes where id = ?",  [$_GET['id']])->fetch();

if (!$note) {
    abort(404);
}

if ($note['user_id'] !== $currentUserId) {
    abort(403);
}

require view("notes/show.view.php", [
    'heading' => 'Note',
    'note' => $note
]);
