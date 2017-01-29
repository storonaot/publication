<?php
	include_once 'config.php';

	function array_sort($array, $on, $order=SORT_ASC) {
	    $new_array = array();
	    $sortable_array = array();

	    if (count($array) > 0) {
	        foreach ($array as $k => $v) {
	            if (is_array($v)) {
	                foreach ($v as $k2 => $v2) {
	                    if ($k2 == $on) {
	                        $sortable_array[$k] = $v2;
	                    }
	                }
	            } else {
	                $sortable_array[$k] = $v;
	            }
	        }

	        switch ($order) {
	            case SORT_ASC:
	                asort($sortable_array);
	            break;
	            case SORT_DESC:
	                arsort($sortable_array);
	            break;
	        }

	        foreach ($sortable_array as $k => $v) {
	            $new_array[$k] = $array[$k];
	        }
	    }

	    return $new_array;
	}

	function __autoload($class) {
		$class = explode('_', $class);
		$path  = '.';
		for ($i = 0, $cnt = count($class); $i < $cnt; $i++) {
			$path.= '/' . $class[$i];
		}
		$path.= '.php';

		if (file_exists($path)) {
			include_once $path;
		}
		else {
			die("Запрашиваемой страницы не существует!");
		}
	}

	Controller_route::start($_SERVER['REQUEST_URI']);
?>
