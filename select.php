<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>

<?php
require 'connect_db.php';

$task_id = $_REQUEST['id'];
$sql = mysqli_query($link, "SELECT task, task_completed FROM tasks WHERE `id`=$task_id");
$task = mysqli_fetch_assoc($sql);
?>

<div class="container" style="margin-top:10px">
    <form action="update.php">
        <div class="row ">
            <div class="col-8 mt-10">
                <input type="hidden" name="id" value="<?=$task_id?>">
                <textarea class="form-control mb-3" name="task" rows="6" cols="30" placeholder="Описание задачи...*"><?= $task['task']?></textarea>
            </div>
        </div>

        <div class="form-check mb-5">
            <input type="hidden" name="task_completed" value="N">
            <input type="checkbox" id="exampleCheck1" name="task_completed" <?php if ($task['task_completed'] == "Y") { ?>  checked="checked" <?php } ?>  value="Y">
            <label class="form-check-label" for="exampleCheck1">Задача выполнена</label>
        </div>

            <button type="sumbit" class="btn btn-success">Обновить задачу</button>
    </form>
</div>
</body>
</html>


