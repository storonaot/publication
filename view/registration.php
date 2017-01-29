
<?php
  $errors = isset($arr['errors']) ? $arr['errors'] : array();

  foreach ($errors as $error) {
    echo '<div>'.$error.'</div>';
  }
?>
<?php include_once('partial/header.php'); ?>

<div class="container">
  <div class="content">
    <form method="post" class="registration">
      <h2 class="like-h1">Зарегистрироваться</h2>

      <div class="registration__field">
        <label class="registration__label">Login</label>
        <input type="text" name="login">
      </div>
      <div class="registration__field">
        <label class="registration__label">Password</label>
        <input type="password" name="password">
      </div>

      <input type="submit" value="Зарегистрироваться" class="button">
    </form>
  </div>
</div>
