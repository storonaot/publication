<?php
	class Model_ads extends Model_publication{
		public function __construct($id) {
		  $this->table = 'ads';
      parent::__construct($id);
		}

		public static function edit($info = array(), $id = 0) {
			if (!empty($info)) {
				return Controller_DB::update('ads', $info, array('id' => $id));
			}
			else {
				return true;
			}
		}

		public static function remove($id = 0) {
			if ($id > 0) {
				return Controller_DB::delete('ads', array('id' => $id));
			}
			else {
				return true;
			}
		}
  }
?>
