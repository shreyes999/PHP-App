<?php

use Core\App;
use Core\Database;
use Core\Validator;
use Http\Forms\LoginForm;

$db = App::resolve(Database::class);

$email = $_POST['email'];
$password = $_POST['password'];

$form = new LoginForm();

if (!$form->validate($email, $password)) {
    return view('session/create.view.php', [
        'error' => $form->error()
    ]);
}

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
