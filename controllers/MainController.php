<?php

function game()
{
    global $VAR;
    session_start();
    $username = $_SESSION['username'];
    session_write_close();
    if ($username) {
        $signed_in = true;
    } else {
        $signed_in = false;
    }
    $sql = opensqlite();
    $best = $sql->query('SELECT `value` FROM `user_state` WHERE `key` = \'bestScore\''
        . ' ORDER BY CAST(`value` AS INTEGER) DESC LIMIT 1')->fetchArray();
    if (!$best) {
        $VAR['best_score'] = '0';
    } else {
        $VAR['best_score'] = $best['value'];
    }
    $VAR['signed_in'] = $signed_in;
    $VAR['username'] = $username;
}

function signin()
{
    if ($_SERVER['REQUEST_METHOD'] === 'GET' && $_GET['err']) {
        $login_failure = true;
    }
    global $VAR;
    $VAR['login_failure'] = isset($login_failure);
}

function session()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(400);
        header('Location: /');
        exit;
    }
    if (!isset($_POST['username'], $_POST['password'])) {
        header('Location: /');
        exit;
    }
    $username = $_POST['username'];
    $password = $_POST['password'];
    $sql = opensqlite();
    $stmt = $sql->prepare('SELECT `password` FROM `user` WHERE `name` = :name');
    $stmt->bindValue(':name', $username);
    $result = $stmt->execute()->fetchArray();
    if ($result && password_verify($password, $result['password'])) {
        header('Location: /game');
    } else {
        header('Location: /?err=✓');
    }
    $stmt->close();
    session_start();
    $_SESSION['username'] = $username;
    session_write_close();
    $sql->close();
}

function signup()
{
    global $VAR;
    $VAR['err'] = isset($_GET['err']) ? $_GET['err'] : null;
}

function register()
{
    if ($_SERVER['REQUEST_METHOD'] !== 'POST'
        || !isset($_POST['username'], $_POST['password'],
            $_POST['password-confirm'])) {
        http_response_code(400);
        exit;
    }
    $username = $_POST['username'];
    $password = $_POST['password'];
    $password_confirm = $_POST['password-confirm'];
    if ($password !== $password_confirm) {
        header('Location: /signup?err=passwordconfirm');
        exit;
    }
    $sql = opensqlite();
    $stmt = $sql->prepare('INSERT INTO `user`(`name`, `password`) VALUES (:username, :pass)');
    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':pass', get_password_hash($password));
    if ($stmt->execute()) {
        session_start();
        $_SESSION['username'] = $username;
        session_write_close();
        header('Location: /game');
    } else {
        header('Location: /signup?err=takenusername');
    }
    $stmt->close();
    $sql->close();
}

function statistic()
{
    global $VAR;
    $sql = opensqlite();
    $result = $sql->query('SELECT * FROM `user_state`'
        . ' WHERE `key` = \'bestScore\' ORDER BY CAST(`value` AS INTEGER) DESC');
    $data = [];
    while (($row = $result->fetchArray()) !== false) {
        array_push($data, ['username' => $row['username'], 'score' => $row['value']]);
    }
    $VAR['data'] = $data;
}