<?php

use Core\Database;

$config = require base_path("config.php");

$db = new Database($config['database']);
$currentUserId = 7;

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $note = $db->query("select * from notes where id = ?",  [$_GET['id']])->fetch();

    authorize($note['user_id'] === $currentUserId);
    $db->query("delete from notes where id=:id", [
        'id' => $_POST['id'],
    ]);
    header('Location:/notes');
    exit();
} else {

    $note = $db->query("select * from notes where id = ?",  [$_GET['id']])->fetch();

    authorize($note['user_id'] === $currentUserId);

    require view("notes/show.view.php", [
        'heading' => 'Note',
        'note' => $note
    ]);
}
