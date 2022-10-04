<?php

require 'config.php';

$link = mysqli_connect($config['servername'], $config['username'], $config['db_password'], '');

$db_name = 'task_book';
$sql = 'CREATE DATABASE $db_name CHARACTER SET utf8 COLLATE utf8_general_ci';

if (mysqli_query($link, $sql)) {
    echo 'The database ' . $db_name . ' has been successfully created';
} else {
    echo 'ERROR: Could not able to execute $sql. ' . mysqli_error($link);
}
mysqli_close($link); ?>

<a href="index.php">Вернуться к регистрации</a>
