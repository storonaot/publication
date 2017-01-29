<?php
$props = $arr['properties'];

?>

<!DOCTYPE html>
<html>
<head>
<title>Новость</title>
</head>
<body>
  <?php include_once('partial/header.php'); ?>
  <div class="container">
    <div class="content">
      <h1 class="like-h1"><?php  echo $props['title']; ?></h1>
      <p><?php  echo $props['text']; ?></p>
      <p class="ads">Источник:<?php  echo $props['source']; ?></p>
    </div>
  </div>
</body>
</html>
