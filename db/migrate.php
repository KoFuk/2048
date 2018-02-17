<?php
function migrate(SQLite3 $sql)
{
    $sql->exec('CREATE TABLE IF NOT EXISTS `user`('
        . '`id` INTEGER PRIMARY KEY,'
        . '`name` VARCHAR(10) NOT NULL UNIQUE,'
        . '`password` VARCHAR(60) NOT NULL)');
    $sql->exec('CREATE TABLE IF NOT EXISTS `user_state`('
        . '`username` VARCHAR(10) NOT NULL,'
        . '`key` VARCHAR(10) NOT NULL,'
        . '`value` VARCHAR(4096) NOT NULL,'
        . 'UNIQUE(`username`,`key`))');
}
