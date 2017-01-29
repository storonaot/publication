<?php
	class Controller_route {
		public static function start($url) {
			$pattern='/\?.*/';
			$url=preg_replace($pattern, '', $url);
			if (strlen(trim(str_replace('/'.BASE, '', $url))) === 0) {
				include_once('view/index.php');
			}
			else {
				$url    = str_replace(BASE, '', trim($url, '/'));
				$info   = explode('/', $url);
				$class  = 'Controller_' . $info[0];
				$method = isset($info[1]) ? htmlspecialchars($info[1]) : '';
				$id     = isset($info[2]) ? (int)$info[2] : 0;
				$class::start($method, $id);
			}
		}
	}
?>
