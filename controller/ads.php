<?php
class Controller_ads extends Controller_publication {
  public static $table = 'ads';

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
    return Controller_DB::getObjectBeforeDate(
      self::$table,
      array('id' => 'id', 'title' => 'title', 'date' => 'date', 'date_actual' => 'date_actual', 'user_id' => 'user_id')
    );
  }

  public function add() {
    if (empty($_POST)) {
      self::view('addForm', array('properties' => self::getProperties(), 'table' => self::$table));
    }
    else {
      if (Model_ads::addNew($_POST, self::$table)) {
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
    $ads = new Model_ads($id);
    self::view(self::$table.'Show', array('properties' => $ads->properties));
  }

  public function update($id) {
    if (empty($_POST)) {
      $ads = new Model_ads($id);

      self::view('editForm', array('publication' => $ads));
    }
    else {
      if (Model_ads::edit($_POST, $id)) {
        header('Location: /' . BASE . 'ads');
      }
      else {
        echo 'Возникла проблема при обновлении записи!';
      }
    }
  }

  public function remove($id = 0) {
			if (Model_ads::remove($id)) {
				header('Location: /' . BASE . 'ads');
			}
			else {
				echo '<p>Не удалось удалить запись!</p>';
			}
		}
}
?>
