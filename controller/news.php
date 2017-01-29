<?php
class Controller_news extends Controller_publication {
  public static $table = 'news';

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
    return Controller_DB::getObject(self::$table, array('id' => 'id', 'title' => 'title', 'date' => 'date', 'source' => 'source', 'user_id' => 'user_id'));
  }

  public function add() {
    if (empty($_POST)) {
      self::view('addForm', array('properties' => self::getProperties(), 'table' => self::$table));
    }
    else {
      if (Model_news::addNew($_POST, self::$table)) {
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
    $news = new Model_news($id);
    self::view(self::$table.'Show', array('properties' => $news->properties));
  }
  public function update($id) {
    if (empty($_POST)) {
      $news = new Model_news($id);

      self::view('editForm', array('publication' => $news));
    }
    else {
      if (Model_news::edit($_POST, $id)) {
        header('Location: /' . BASE . 'news');
      }
      else {
        echo 'Возникла проблема при обновлении записи!';
      }
    }
  }
  public function remove($id = 0) {
      if (Model_news::remove($id)) {
        header('Location: /' . BASE . 'news');
      }
      else {
        echo '<p>Не удалось удалить запись!</p>';
      }
    }
}
?>
