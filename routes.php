<?php

$router->get('/', 'controller/index.php');
$router->get('/about', 'controller/about.php');
$router->get('/contact', 'controller/contact.php');

$router->get('/notes', 'controller/notes/index.php')->only('auth');
$router->get('/notes/create', 'controller/notes/create.php');
$router->get('/notes/edit', 'controller/notes/edit.php');
$router->patch('/notes/update', 'controller/notes/update.php');
$router->post('/notes', 'controller/notes/store.php');

$router->get('/note', 'controller/notes/show.php');
$router->delete('/note', 'controller/notes/destroy.php');

$router->get('/register', 'controller/registration/create.php')->only('guest');
$router->post('/register', 'controller/registration/store.php');
