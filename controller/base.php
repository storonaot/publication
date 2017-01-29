<?php
	abstract class Controller_base {
		public static function view($page, $arr = array()) {
			foreach($arr as $var => $val) {
				$$var = $val;
			}
			include "./view/$page.php";
		}

		abstract function start($method, $id);
	}
?>
