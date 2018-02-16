<?php
include __DIR__ . '/projectstd.php';

$url = strtolower($_SERVER['REQUEST_URI']);
$q_position = strpos($url, '?');
if ($q_position !== false) {
    $url = substr($url, 0, $q_position);
}

switch ($url) {
    case '/':
    case '/signin':
        to('main', 'signin');
        break;
    case '/session':
        to('main', 'session');
        break;
    case '/signup':
        to('main', 'signup');
        break;
    case '/register':
        to('main', 'register', false);
        break;
    case '/game':
        to('main', 'game');
        break;
    case '/statistic':
        to('main', 'statistic');
        break;
    case '/internal/storage':
        to('internal', 'storage', false);
        break;
    default:
        http_response_code(404);
        to('error', 'notfound');
}

$VAR = [];

function to(string $controller, string $action, bool $has_view = true)
{
    $name = strtoupper(substr($controller, 0, 1)) . substr($controller, 1);
    include __DIR__ . '/controllers/' . $name . 'Controller.php';
    call_user_func($action);
    if ($has_view) {
        global $VAR;
        foreach ($VAR as $k => &$v) {
            $$k = $v;
        }
        unset($controller, $VAR, $k, $v);
        include __DIR__ . '/views/' . $name . '/' . $action . '.html.php';
    }
}
