<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
  <title>Tasks</title>
</head>

<body>
  <style>
    a {
      text-decoration: none;
      font-size: 25px;
      color: black;
      font-weight: bold;

    }

    a.active {
      text-decoration: underline;

    }
  </style>
  <?php
  require "connect_db.php";
  
  if (isset($_GET['success'])) { ?> <div class="alert alert-success"> Задание добавлено </div>
  <?php }
 if (isset($_GET['error'])) { ?>
    <div class="alert alert-danger"> Заполните все поля </div>

  <?php }
  if (isset($_GET['error_email'])) { ?> <div class="alert alert-danger"> Такой e-mail уже существует. Придумайте другой. </div>
  <?php }

if (isset($_GET['error_verify'])) { ?> <div class="alert alert-danger"> Не верные данные для входа в административную панель </div>
  <?php }


  if (isset($_GET['page'])) {
    $page = $_GET['page'];
  } else {
    $page = 1;
  }
  $notesOnPage = 3;
  $from = ($page - 1) * $notesOnPage;
  $sql_count = mysqli_query($link, "SELECT COUNT(*) as count  FROM tasks");
  $count = mysqli_fetch_assoc($sql_count)['count'];
  $pagesCount = ceil($count / $notesOnPage);

  $sql = mysqli_query($link, "SELECT * FROM tasks LIMIT $from,$notesOnPage");

  while (($record = mysqli_fetch_assoc($sql))) {
    $tasks[] = $record;
  }


if(isset($tasks)) { ?>

<div class="container">

  <div class="row"> 
    <div class="col-8">
      <h2 class="text-center mb-5">Панель администратора</h2>
    </div>
  </div>

  <div class="row align-items-center mb-3">
    <div class="col-8">
      <table class="table table-success table-striped">
        <thead class="table-secondary">
          <tr>
            <th>Имя пользователя</th>
            <th>E-mail</th>
            <th>Задача</th>
            <th>Редактировать задачу</th>
            <!-- <th>Задача выполнена</th> -->
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tasks as $task) : ?>
<form action="update.php" method="POST">
              <tr>
                <td><?php echo $task["name"] ?></td>
                <td><?php echo $task["email"] ?></td>
                <td><?php echo $task["task"] ?></td>
                <td><a href="select.php?id=<?= $task["id"]?>" style="font-weight:normal; font-size:20px; color:#321312; text-decoration:underline;">Update</a></td>

                <td><?php  if ($task['task_completed'] == "Y") {echo 'Отредактировано администратором';}?></td> 
              </tr>

          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  </div>

      <!-- Pagination -->
  <div class="row align-items-center">
      <div class="col-8">
        <?php 
          if ($page > 1) {
            $pageToLeft = $page - 1;
            echo "<a href='?page=$pageToLeft'> < </a>";
          }

          for ($i = 1; $i <= $pagesCount; $i++) {
            if ($page == $i) {
              echo "<a href='?page=$i' class='active'> $i </a>";
            } else {
              echo "<a href ='?page=$i'> $i </a>";
            }
          }

          if ($page != $pagesCount) {
            $pageToRight = $page + 1;
            echo "<a href = '?page=$pageToRight'> > </a>";
          } 
} ?>
      </div>
  </div>


  <button type="sumbit" class="btn btn-outline-dark">Сохранить</button>
</form>

  <div class="mt-3 mb-3">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
      Добавить новую задачу
    </button>
    
    <!-- Modal -->
    <form action="handler.php" method="post">
      <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">

            <div class="modal-header">
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
            <input type="text" class="form-control mb-3" name="name" placeholder="Имя*">
            <input type="email" class="form-control mb-3" name="email" placeholder="E-mail*" required>
            <textarea class="form-control mb-3" name="task" rows="6" cols="30" placeholder="Описание задачи...*"></textarea>
            </div>

            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Закрыть</button>
              <button type="sumbit" class="btn btn-success">Добавить задачу</button>
            </div>

          </div>
        </div>
      </div>
    </form>
  </div>


<div>
<a href="index.php" class="btn btn-outline-info">Вернуться на главную страницу</a>
</div>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous"></script>

</body>

</html>






