<?php
require 'connect_db.php';

$sql = 'CREATE TABLE tasks (
id INT(11) PRIMARY KEY AUTO_INCREMENT,
name VARCHAR(256) NOT NULL,
email VARCHAR(256) UNIQUE,
task TEXT,
task_completed CHAR(1) NOT NULL default N,
)';

if (!mysqli_query($link, $sql)) {
  echo 'ERROR: Problem with creating a table $sql'  . mysqli_error($link);
} 
$link->close();
