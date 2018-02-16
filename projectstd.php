<?php

function opensqlite(): SQLite3
{
    $sql = new SQLite3('db/app.db');
    include __DIR__ . '/db/migrate.php';
    migrate($sql);
    return $sql;
}

function render_json($any)
{
    header('Content-Type: application/json');
    echo json_encode($any);
}

function render(string $data, string $type)
{
    header("Content-Type: $type");
    echo $data;
}

function get_password_hash(string $password): string
{
    $options = [
        'cost' => 15
    ];
    return password_hash($password, PASSWORD_BCRYPT, $options);
}
