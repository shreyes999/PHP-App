<?php

$config = require("config.php");

$db = new Database($config['database']);
// $id = $_GET['id'];
// $query = "SELECT * FROM post where id=?";
// $post = $db->query($query, [$id])->fetch();


$query = "select * from notes where user_id = ? ";
$id = 7;
$notes = $db->query($query, param: [$id])->fetchAll();


$heading = "My Notes";
require "views/notes/index.view.php";
