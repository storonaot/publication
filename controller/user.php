<?php
class Controller_user extends Controller_base {
  public function __construct($session){
    $user = new Model_user($session);

    $this->isAuth = $this->auth($user);
    $this->login = $user->login;
    $this->id = $user->id;
    }

  public function start($method, $id) {
    if (!$method) {
      self::showList();
    }
    else {
      self::$method($id);
    }
  }

  public function auth($user){
    return isset($user) AND $user->session !== null AND $user->session == $_COOKIE['session'];
  }

  public function registration(){
    $session = isset($_COOKIE['session']) ? $_COOKIE['session'] : false;
    $referer = isset($_GET['referer']) ? '/'.BASE.$_GET['referer'] : '/'.BASE.'';
    if ($session) {
      header('Location: '.$referer);
    }
    else {
      if (empty($_POST)) {
        self::view('registration');
      }
      else {
        if (!empty($_POST['login']) AND !empty($_POST['password'])) {
          $already_exist = Model_user::userExist($_POST['login']);

          if($already_exist){
            self::view('registration', array('errors' => array('Логин уже существует')));
          }
          else{
            Model_user::createUser($_POST['login'], $_POST['password']);
          }
        }
        else {
          self::view('registration', array('errors' => array('Заполните форму')));
        }
      }
    }
  }


  public function login($login='', $password=''){
    if (!empty($_POST)) {
      $login = $_POST['login'];
      $password = $_POST['password'];
    }

    $userId = Model_user::checkUser($login, $password);

    if ($userId) {
      self::createSession($userId);

      $referer = isset($_GET['referer']) ? '/'.BASE.$_GET['referer'] : '/'.BASE.'';

      header('Location: '.$referer);
    }
    else {
      self::view('index', array('errors' => array('Неверная связка Логин/Пароль!')));
    }
  }

  public function logout(){
    $session = isset($_COOKIE['session']) ? $_COOKIE['session'] : false;
    if ($session) {
      Controller_DB::delete('connect', array('session'=>$session));
      setcookie('session','', time()+3600, '/publication');
    }

    $referer = isset($_GET['referer']) ? '/'.BASE.$_GET['referer'] : '/'.BASE.'';

    header('Location: '.$referer);

  }

  public function createSession($userId){
    $hash = self::getHash();

    echo $hash;

    Controller_DB::insert('connect', array('id_user' => $userId, 'session' => $hash));

    setcookie('session', $hash, time()+3600, '/publication');
  }

  public function getHash() {
    $str  = "abcdefghijklmnopqrstuvwxyz0123456789";
    $hash = '';
    for ($i = 0; $i < 32; $i++) {
      $hash.= $str[rand(0, 35)];
    }
    return $hash;
  }
}
?>
