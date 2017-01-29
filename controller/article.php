<?php
class Controller_article extends Controller_publication {
  public static $table = 'article';

  public function start($method, $id) {
    if (!$method) {
      self::showList();
    }
    else {
      self::$method($id);
    }
  }

  public function getProperties() {
    return Controller_DB::getInfo(self::$table);
  }

  public function getList() {
    return Controller_DB::getObject(self::$table, array('id' => 'id', 'title' => 'title', 'author' => 'author', 'user_id' => 'user_id'));
  }

  public function add() {
    if (empty($_POST)) {
      self::view('addForm', array('properties' => self::getProperties(), 'table' => self::$table));
    }
    else {
      if (Model_article::addNew($_POST, self::$table)) {
        header('Location: /' . BASE . self::$table);
      }
      else {
        echo 'Возникла проблема при создании записи!';
      }
    }
  }

  public function showList() {
    self::view(self::$table.'List', array('list' => self::getList()));
  }

  public function show($id) {
    $article = new Model_article($id);
    self::view(self::$table.'Show', array('canRate' => self::userCanRate($id), 'rate' => $article->rate, 'rateCount' => $article->rateCount,'properties' => $article->properties));
  }

  public function userCanRate($articleId){
    $session = isset($_COOKIE['session']) ? $_COOKIE['session'] : false;
    if (!$session) {
      return false;
    }
    else {
      $user = new Model_user($session);
      $userId = $user->id;
      $query="SELECT * FROM `rate` WHERE `article_id`='$articleId' AND `user_id`='$userId'";
      $rate = Controller_DB::query($query);

      return empty($rate);
    }

  }
  public function update($id) {
    if (empty($_POST)) {
      $article = new Model_article($id);

      self::view('editForm', array('publication' => $article));
    }
    else {
      if (Model_article::edit($_POST, $id)) {
        header('Location: /' . BASE . 'article');
      }
      else {
        echo 'Возникла проблема при обновлении записи!';
      }
    }
  }

  public function remove($id = 0) {
			if (Model_article::remove($id)) {
				header('Location: /' . BASE . 'article');
			}
			else {
				echo '<p>Не удалось удалить запись!</p>';
			}
		}

    public function rate($articleId){
      if(!empty($_POST) AND isset($_POST['rate'])){
        $rate=$_POST['rate'];
        $session = isset($_COOKIE['session']) ? $_COOKIE['session'] : false;
        $user = $session ? new Model_user($session) : false;

        if(!$user){
          header('Location: /' . BASE . 'article/show/'.$articleId);
        }
        else{
          $userId = $user->id;

          echo Controller_DB::insert('rate', array('article_id'=>$articleId, 'user_id'=>$userId, 'rate'=>$rate));

          header('Location: /' . BASE . 'article/show/'.$articleId);
        }
      }
      else {
        header('Location: /' . BASE . 'article/show/'.$articleId);
      }
    }

}
?>
