<?php

use Core\App;
use Core\Database;
use Core\Validator;

$email = $_POST['email'];
$password = $_POST['password'];

$error = [];
if (!Validator::email($email)) {
    $error['email'] = 'Please provide a valid email address';
}
if (!Validator::string($password)) {
    $error['password'] = 'Please provide a valid password';
}
if (!empty($error)) {
    return view('session/create.view.php', [
        'error' => $error
    ]);
}
$db = App::resolve(Database::class);

$user = $db->query('select * from users where email = :email ', [
    'email' => $email,
])->fetch();

if ($user) {
    if (password_verify($password, $user['password'])) {

        login([
            'email' => $email
        ]);

        header('location:/');
        exit();
    }
}

return view('session/create.view.php', [
    'error' => [
        'emailPass' => 'No matching account found for email address and password'
    ]
]);
