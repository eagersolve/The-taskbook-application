<?php
require 'config.php';

$link = mysqli_connect(
    $config['servername'],
    $config['username'],
    $config['db_password'],
    $config['db'] 
);
mysqli_set_charset($link, 'utf8mb4');

if (!$link) {
    die('ERROR: Connection failed: ' . mysqli_connect_error());
}
