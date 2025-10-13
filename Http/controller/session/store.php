<?php

use Http\Forms\Authenticator;
use Http\Forms\LoginForm;

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if ($form->validate($email, $password)) {
    $auth = new Authenticator();
    if ($auth->attempt($email, $password)) {
        header('location:/');
        exit();
    }
    $form->addError('emailPass', 'No matching account found for email address and password');
}

return view('session/create.view.php', [
    'error' => $form->error()
]);
