<?php
class Model_user {
  public function __construct($session) {
    $user = self::getUser($session);

    $this->login = $user['login'];
    $this->session = $user['session'];
    $this->id = $user['id_user'];
  }

  public function getUser($session){
    $query = "SELECT * FROM `user` LEFT JOIN `connect` ON( `user`.`id` = `connect`.`id_user` ) WHERE `session` = '$session'";
    return Controller_DB::query($query);
  }
  public function userExist($login){
    $query = "SELECT * FROM `user` WHERE `login` = '$login'";
    $user = Controller_DB::query($query);

    return !empty($user);
  }

  public function createUser($login, $password){
    $user = array('login'=>$login, 'password'=>md5($password));
    $userId = Controller_DB::insert('user', $user);

    if ($userId > 0) {
      Controller_user::login($login, $password);
    }
    else {
      echo 'Произошла ошибка БД';
    }
  }

  public function checkUser($login, $password) {
    $pass = md5($password);
    $query = "SELECT `id` FROM `user` WHERE `login` = '$login' AND `password`  = '$pass'";
    $userId = Controller_DB::query($query);

    return empty($userId) ? false : $userId['id'];
  }
}
?>
