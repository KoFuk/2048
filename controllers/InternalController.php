<?php

function storage()
{
    session_start();
    $username = $_SESSION['username'];
    if (!$username) {
        render('{}','application/json');
        exit;
    }
    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        $sql = opensqlite();
        $stmt = $sql->prepare('SELECT * FROM `user_state`'
            . ' WHERE `username` = :name');
        $stmt->bindValue(':name', $username);
        $result = $stmt->execute();
        $data = [];
        while (($row = $result->fetchArray()) !== false) {
            $data[$row['key']] = $row['value'];
        }
        render_json($data);
        $stmt->close();
        $sql->close();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!isset($_POST['key'], $_POST['value'])) {
            http_response_code(400);
            exit;
        }
        $key = $_POST['key'];
        $value = $_POST['value'];
        $sql = opensqlite();
        $stmt = $sql->prepare('DELETE FROM `user_state`'
            . ' WHERE username = :name AND key = :state_key');
        $stmt->bindValue(':name', $username);
        $stmt->bindValue(':state_key', $key);
        $stmt->execute();
        $stmt->close();
        $stmt = $sql->prepare('INSERT INTO `user_state` (`username`, `key`, `value`)'
            . ' VALUES (:name, :state_key, :state_value)');
        $stmt->bindValue(':name', $username);
        $stmt->bindValue(':state_key', $key);
        $stmt->bindValue(':state_value', $value);
        $stmt->execute();
        $stmt->close();
        $sql->close();
    } elseif ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
        $sql = opensqlite();
        $stmt = $sql->prepare('DELETE FROM `user_state`'
            . ' WHERE `username` = :name AND `key` = \'gameState\'');
        $stmt->bindValue(':name', $username);
        $stmt->execute();
        $stmt->close();
        $sql->close();
    }
}
