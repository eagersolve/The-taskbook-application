<?php
require 'connect_db.php';

$task_id = $_REQUEST['id'];
$task = $_REQUEST['task'];
$task_completed = $_REQUEST['task_completed'];

$sql = mysqli_query($link, "UPDATE `tasks` SET `task` = '$task', `task_completed` = '$task_completed'  WHERE `id` = $task_id");

header('location:admin.php');
die;
