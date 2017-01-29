<?php
  $arrNews = Controller_news::getList();
  $arrAds = Controller_ads::getList();
  $arrArticle = Controller_article::getList();
?>

<!DOCTYPE html">
<html>
<head>
  <title>Список публикаций</title>
</head>
<body>
  <?php include_once('partial/header.php'); ?>

  <div class="container">
    <div class="content">
      <h1 class="like-h1">Добро пожаловать на портал Publication!</h1>

      <? if (!$user): ?>
        <p class="center">Чтобы начать работу с порталом, авторизуйтесь!</p>
      <? else: ?>
        <div class="block">
          <div class="title">
            <h2 class="like-h2">Новости</h2>
            <a href="/<?=BASE?>news/add/" class="button">Добавить новую запись</a>
          </div>
          <?foreach($arrNews as $news):?>
            <div rel="<?=$news->id?>" class="item">
              <a class="link" href="/<?=BASE?>news/show/<?=$news->id?>"><?=$news->title ?></a>
              <?php if ($user AND $user->isAuth AND $news->user_id===$user->id) echo '<a class="edit" href="/' .BASE. 'news/update/'.$news->id.'"></a>'; ?>
              <?php if ($user AND $user->isAuth AND $news->user_id===$user->id) echo '<a class="delete" href="/' .BASE. 'news/remove/'.$news->id.'"></a>'; ?>
            </div>
          <?endforeach?>
        </div>
        <div class="block">
          <div class="title">
            <h2 class="like-h2">Объявления</h2>
            <a href="/<?=BASE?>ads/add/" class="button">Добавить новую запись</a>
          </div>
          <?foreach($arrAds as $ads):?>
            <div rel="<?=$ads->id?>" class="item">
              <a class="link" href="/<?=BASE?>ads/show/<?=$ads->id?>"><?=$ads->title ?></a>
              <?php if ($user AND $user->isAuth AND $ads->user_id===$user->id) echo '<a class="edit" href="/' .BASE. 'ads/update/'.$ads->id.'"></a>'; ?>
              <?php if ($user AND $user->isAuth AND $ads->user_id===$user->id) echo '<a class="delete" href="/' .BASE. 'ads/remove/'.$ads->id.'"></a>'; ?>
            </div>
          <?endforeach?>
        </div>
        <div class="block">
          <div class="title">
            <h2 class="like-h2">Статьи</h2>
            <a href="/<?=BASE?>article/add/" class="button">Добавить новую запись</a>
          </div>
          <?foreach($arrArticle as $article):?>
            <div rel="<?=$article->id?>" class="item">
              <a class="link" href="/<?=BASE?>article/show/<?=$article->id?>"><?=$article->title ?></a>
              <?php if ($user AND $user->isAuth AND $article->user_id===$user->id) echo '<a class="edit" href="/' .BASE. 'article/update/'.$article->id.'"></a>'; ?>
              <?php if ($user AND $user->isAuth AND $article->user_id===$user->id) echo '<a class="delete" href="/' .BASE. 'article/remove/'.$article->id.'"></a>'; ?>
            </div>
          <?endforeach?>
        </div>
      <? endif; ?>
    </div>
  </div>

</body>
</html>
