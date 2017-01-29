<?php
$props = $arr['properties'];
$session = isset($_COOKIE['session']) ? $_COOKIE['session'] : false;
$user = $session ? new Model_user($session) : false;
?>
<!DOCTYPE html>
<html>
<head>
<title>Статья</title>
</head>
<body>
  <?php include_once('partial/header.php'); ?>
  <div class="container">
    <div class="content">
      <h1 class="like-h1"><?php  echo $props['title']; ?></h1>
      <p><?php  echo $props['text']; ?></p>
      <p class="author">Автор: <?php  echo $props['author']; ?></p>
      <div class="rating">
        <p>Средняя оценка: <?php echo $arr['rate'] ?></p>
        <p>Количество оценок: <?php echo $arr['rateCount'] ?></p>
      </div>
      <?php
        if ($arr['canRate']){
        ?>
        <form action="/<?=BASE?>article/rate/<?=$props['id']?>" method="post">
          <div class="form__field" style="max-width:30%;">
            <label class="form__label">Проголосовать</label>
            <select name="rate">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
            </select>
          </div>

            <input type="submit" value="Проголосовать" class="button">
        </form>
        <?php
        }
       ?>
     </div>
   </div>
</body>
</html>
