<?php

$config = require("config.php");

$db = new Database($config['database']);

$heading = "Note";
$currentUserId = 7;

$note = $db->query("select * from notes where id = ?",  [$_GET['id']])->fetch();

if (!$note) {
    abort(404);
}

if ($note['user_id'] !== $currentUserId) {
    abort(403);
}

require "views/notes/show.view.php";
