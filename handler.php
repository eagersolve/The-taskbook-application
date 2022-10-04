<?php

require_once 'connect_db.php';

$name = trim($_REQUEST['name']);
$email = trim($_REQUEST['email']);
$task = trim($_REQUEST['task']);
$login = trim($_REQUEST['login_admin']);
$password = trim($_REQUEST['password_admin']);

if (!empty($login)) {
    if ($login === 'admin' && $password === '123') { 
        header('location:admin.php');
        die;
    } else {
        header('location:index.php?error_verify');
        die;
    }
}

mysqli_query($link, "SELECT * FROM tasks WHERE email =  $email"); 

if ((mysqli_affected_rows($link) > 0)) {
    header('location:index.php?error_email');
    die;
}


if ($name == '' || $task == '') {
    header('location:index.php?error');
    die;
} 

$sql = "INSERT INTO tasks (name, email, task) VALUES 
        ('$name', '$email', '$task')";

$task_is_created = mysqli_query($link, $sql);
header('location:index.php?success');
die;
