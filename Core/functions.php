<?php

use Core\Response;

function isCurrentPage($url)
{
    return $_SERVER["REQUEST_URI"] === $url;
}
function dd($value)
{
    echo "<pre>";

    var_dump($value);

    echo "<pre>";

    die();
}
function base_path($path)
{
    return BASE_PATH . $path;
}
function view($path, $attributes = [])
{
    extract($attributes);
    require base_path("views/" . $path);
}
function abort($code = 404)
{
    http_response_code($code);

    require base_path("views/{$code}.php");

    die();
}
function authorize($condition, $status = Response::FORBIDDEN)
{
    if (! $condition) {
        abort($status);
    }

    return true;
}
function login($email)
{
    $_SESSION['user'] = [
        'email' => $email
    ];
    session_regenerate_id(true);
}
function logout()
{
    $_SESSION = [];

    session_destroy();

    $param = session_get_cookie_params();

    setcookie('PHPSESSID', '', time() - 3600, $param['path'], $param['secure'], $param['httponly']);
}
