<?php

use Core\Session;

view("session/create.view.php", [
    'error' => Session::get('error')
]);
