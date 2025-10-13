<?php

namespace Http\Forms;

use Core\Validator;

class LoginForm
{
    protected  $error = [];
    public function validate($email, $password): bool
    {

        if (!Validator::email($email)) {
            $this->error['email'] = 'Please provide a valid email address';
        }
        if (!Validator::string($password)) {
            $this->error['password'] = 'Please provide a valid password';
        }
        return empty($this->error);
    }
    public function error()
    {
        return $this->error;
    }
}
