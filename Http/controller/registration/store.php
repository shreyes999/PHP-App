<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Http\Forms\Authenticator;

$email = $_POST['email'];
$password = $_POST['password'];

$error = [];
if (!Validator::email($email)) {
    $error['email'] = 'Please provide a valid email address';
}
if (!Validator::string($password, 7, 255)) {
    $error['password'] = 'Please provide a password of atleast 7 characters';
}
if (!empty($error)) {
    return view('registration/create.view.php', [
        'error' => $error
    ]);
}
$db = App::resolve(Database::class);
$user = $db->query('select (email) from users where email = :email', [
    'email' => $email
])->fetch();

if ($user) {
    return view('registration/create.view.php', [
        'error' => [
            'emailPass' => 'Registration failed'
        ]
    ]);
} else {
    $db->query('INSERT INTO users (email,password)VALUES(:email,:password)', [
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT)
    ]);

    (new Authenticator)->login([
        'email' => $email
    ]);

    header('location:/');
    exit();
}
