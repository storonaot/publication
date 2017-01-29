<?php
$props = $arr['properties'];
?>

<!DOCTYPE html>
<html>
<head>
<title>Объявление</title>
</head>
<body>
  <?php include_once('partial/header.php'); ?>
  <div class="container">
    <div class="content">
      <h1 class="like-h1"><?php echo $props['title']; ?></h1>
      <p><?php echo $props['text']; ?></p>
      <p class="ads">Опубликовано: <?php echo $props['date']; ?></p>
      <p class="ads">Актуально до:<?php echo $props['date_actual']; ?></p>
    </div>
  </div>
</body>
</html>
