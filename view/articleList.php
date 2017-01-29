<!DOCTYPE html>
<html>
<head>
<title>Список статей</title>
</head>
<body>
  <?php include_once('partial/header.php'); ?>
  <div class="container">
    <div class="content">
      <h1 class="like-h1">Список статей</h1>
      <table class="table">

        <tr>
          <th>Заголовок</th>
          <th>Автор</th>
        </tr>
        <?php
        foreach ($list as $value) {
          echo '<tr>
                  <td><a class="link" href="/'.BASE.'article/show/'.$value->id.'">'.$value->title .'</a></td>
                  <td>'.$value->author .'</td>
                </tr>';
        }

        ?>
      </table>
    </div>
  </div>
</body>
</html>
