<!DOCTYPE html>
<html>
<head>
<title>Список объявлений</title>
</head>
<body>
  <?php include_once('partial/header.php'); ?>
  <div class="container">
    <div class="content">
      <h1 class="like-h1">Список объявлений</h1>
      <table class="table">
        <tr>
          <th>Заголовок</th>
          <th>Дата публикации</th>
          <th>Дата актуальности</th>
        </tr>
        <?php
        foreach ($list as $value) {
          echo '<tr>
                  <td><a class="link" href="/'.BASE.'ads/show/'.$value->id.'">'.$value->title .'</a></td>
                  <td>'.date_format(date_create($value->date), "d.m.Y").'</td>
                  <td>'.date_format(date_create($value->date_actual), "d.m.Y").'</td>
                </tr>';
        }

        ?>
      </table>
    </div>
  </div>

</body>
</html>
