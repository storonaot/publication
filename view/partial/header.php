<style>
  body {
    padding: 0;
    margin: 0;
    font-family: sans-serif;
    color: #252525;
    font-size: 16px;
  }
  form {
    margin: 0;
    padding: 0;
  }
  .container {
    max-width: 960px;
    margin: 0 auto;
    padding: 0 20px;
    width: 100%;
  }
  .content {
    padding: 40px 0
  }
  .like-h1 {
    margin: 0;
    text-align: center;
    margin-bottom: 1em;
  }
  .center {
    text-align: center;
  }
  .header {
    height: 50px;
    /*background-color: red;*/
    display: flex;
    justify-content: space-between;
    align-items: center;
    box-shadow: 1px 1px 12px -1px rgba(0, 0, 0, 0.22);
  }
  .auth {
    display: flex;
    align-items: center;
    justify-content: space-between;
  }
  .auth__field, .auth__action {
    margin-left: 10px;
    margin-right: 10px;
  }
  .auth__field-group {
    display: flex;
    align-items: center;
  }
  .auth__label {
    margin-right: 10px;
  }
  .auth__field:first-child {
    margin-left: 0;
  }
  .link {
    color: gray;
    text-decoration: none;
    cursor: pointer;
  }
  .link:hover {
    text-decoration: underline;
  }
  .nav {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 0;
    list-style-type: none;
  }
  .nav__hello {
    display: flex;
    align-items: center;
  }
  .nav__list {
    display: flex;
    align-items: center;
  }
  .nav__item {
    margin-left: 20px;
  }
  .nav__item:first-child {
    margin-left: 0;
  }
  .nav__text {
    margin-right: 10px;
  }
  .button {
    background-color: #fff;
    font-size: inherit;
    border: 1px solid rgba(128, 128, 128, 1);
    color: rgba(128, 128, 128, 1);
    cursor: pointer;
    display: inline-block;
    padding: 5px 10px;
    text-decoration: none;
  }
  .button:hover {
    color: #fff;
    background-color: rgba(128, 128, 128, 1);
  }
  .registration {
    width: 50%;
    margin: 0 auto;
    border: 1px solid gray;
    padding: 30px;
    text-align: center;
  }
  .registration__field {
    display: flex;
    flex-direction: column;
    margin-bottom: 20px;
    align-items: baseline;
    width: 100%;
  }

  .registration__field input {
    width: 100%;
  }

  .registration__label {
    margin-bottom: 5px;
  }
  .block {
    margin-bottom: 2em;
    border-bottom: 1px solid grey;
    padding: 0 0 20px 0;
  }
  .title {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 0.8em

  }
  .like-h2 {
    margin: 0;
  }
  .item {
    display: flex;
    margin-bottom: 10px;
    font-size: 1.2em;
    align-items: center;
  }
  .edit {
    background-image: url('//icon-icons.com/icons2/37/PNG/512/pencil_4076.png');
    width: 20px;
    height: 20px;
    background-size: contain;
    margin-left: 10px;
    cursor: pointer;
  }
  .delete {
    background-image: url('//s1.iconbird.com/ico/2013/10/464/w512h5121380984608delete.png');
    width: 20px;
    height: 20px;
    background-size: contain;
    margin-left: 10px;
    cursor: pointer;
  }
  .form {
    width: 50%;
    margin: 0 auto;
    border: 1px solid gray;
    padding: 30px;
    display: flex;
    flex-direction: column;
    align-items: baseline;
  }
  .form__field {
    display: flex;
    flex-direction: column;
    width: 100%;
    margin-bottom: 20px;
  }
  .form__field input {
    width: 100%;
  }
  .form__label {
    margin-bottom: 5px;
  }
  .table {
    width: 100%;
  }
  .table th, .table td {
    border: 0;
    border-bottom: 1px solid gray;
    padding: 10px;
    text-align: left;
  }
  .rating {
    color: gray;
    display: flex;
    font-size: 0.9em;
    justify-content: space-between;
    max-width: 40%;
  }
  .author {
    font-style: italic;
  }
  .ads {
    color: gray;
    font-size: 0.9em;
  }
  .error {
    position: absolute;
    background-color: #fbc8c8;
    color: red;
    padding: 10px 20px;
    border: 1px solid red;
    border-radius: 5px;
    top: 60px;
    left: 10px;
    top: 220px;
    left: 50%;
    transform: translateX(-50%);
  }

</style>

<header class="header">
  <div class="container">
<?php
  $session = isset($_COOKIE['session']) ? $_COOKIE['session'] : false;
  $user = $session ? new Controller_user($session) : false;

  $errors = isset($arr['errors']) ? $arr['errors'] : array();

  foreach ($errors as $error) {
    echo '<div class="error">'.$error.'</div>';
  }

  if ($user AND $user->isAuth) {
    ?>
      <ul class="nav">
        <div class="nav__list">
          <li class="nav__item"><a class="link" href="/publication/">Home</a></li>
          <li class="nav__item"><a class="link" href="/<?=BASE?>news">Новости</a></li>
          <li class="nav__item"><a class="link" href="/<?=BASE?>ads">Объявления</a></li>
          <li class="nav__item"><a class="link" href="/<?=BASE?>article">Статьи</a></li>
        </div>
        <div class="nav__hello">
          <p class="nav__text">Привет, <?=$user->login?></p>
          <a href="/<?=BASE?>user/logout" class="link">Выйти</a>
        </div>
      </ul>
      <?php
  }
  else{
    ?>
    <form action="/<?=BASE?>user/login" method="post" class="auth">
      <div class="nav__item"><a class="link" href="/publication/">Home</a></div>
      <div class="auth__field-group">
        <div class="auth__field">
          <label class="auth__label">Логин</label>
          <input type="text" name="login">
        </div>
        <div class="auth__field">
          <label class="auth__label">Пароль</label>
          <input type="password" name="password">
        </div>

        <div class="auth__action">
          <input type="submit" value="Войти" class="button">
        </div>
        <a href="/<?=BASE?>user/registration" class="link">Зарегистрироваться</a>
      </div>

    </form>
    <?php
  }
 ?>
</div>

</header>
