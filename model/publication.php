<?php
abstract class Model_publication {
  public function __construct($id){
    $result = Controller_DB::getProperties($this->table, $id);
    $this->properties = $result;
  }

  public static function getInfo($id) {
    return Controller_DB::getObject($this->table, $this->properties, array('id' => $id));
  }

  public static function getList() {
    return Controller_DB::getObject($this->table, $this->properties);
  }

  public static function addNew($info = array(), $table = self::table) {
    if (!empty($info)) {
      return Controller_DB::insert($table, $info);
    }
    else {
      return true;
    }
  }
}


  ?>
