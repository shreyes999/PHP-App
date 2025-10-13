<?php

namespace Http\Forms;

use Core\App;
use Core\Database;

class Authenticator
{
    public function attempt($email, $password)
    {
        $user = App::resolve(Database::class)->query('select * from users where email = :email ', [
            'email' => $email,
        ])->fetch();

        if ($user) {
            if (password_verify($password, $user['password'])) {

                $this->login([
                    'email' => $email
                ]);

                return true;
            }
        }
        return false;
    }
    public function login($email)
    {
        $_SESSION['user'] = [
            'email' => $email
        ];
        session_regenerate_id(true);
    }
    public function logout()
    {
        $_SESSION = [];

        session_destroy();

        $param = session_get_cookie_params();

        setcookie('PHPSESSID', '', time() - 3600, $param['path'], $param['secure'], $param['httponly']);
    }
}
