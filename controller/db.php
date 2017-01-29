<?php
	final class Controller_DB {
		public static $connect;

		public static function connect() {
			if (!self::$connect) {
				self::$connect = mysqli_connect(HOST, USER, PASS, DB);
				mysqli_set_charset(self::$connect, 'UTF8');
			}
		}

		private function __construct() {}
		private function __clone(){}
		private function __sleep(){}
		private function __wakeup(){}

		public static function getProperties($table, $id) {
			self::connect();
			$query = 'SELECT * FROM ' . self::escape($table) . ' WHERE id=' . $id . ' LIMIT 1';
			$res = mysqli_query(self::$connect, $query);

			return mysqli_fetch_assoc($res);
		}

		public static function getInfo($table) {
			self::connect();
			$query = 'SELECT * FROM `' . self::escape($table) . '` LIMIT 1';
			$res = mysqli_query(self::$connect, $query);

			return mysqli_fetch_assoc($res);
		}

		public static function getObject($table, $cols = array(), $where = array()) {
			self::connect();
			$query = "SELECT ";
			foreach ($cols as $col => $as) {
				$query.= ' `' . self::escape($col) . '`';
				if ($as) {
					$query.= ' AS `' . self::escape($as) . '`';
				}
				$query.= ',';
			}
			$query = trim($query, ',');
			$query.= ' FROM `' . self::escape($table) . '` WHERE 1 ';
			foreach ($where as $col => $val) {
				$query.= ' AND `' . self::escape($col) . '` = "' . self::escape($val) . '"';
			}
			$res = mysqli_query(self::$connect, $query);
			$array = array();

			while($obj = mysqli_fetch_object($res)) {
				$array[] = $obj;
			}

			return $array;
		}

		public static function getObjectBeforeDate($table, $cols = array()) {
			self::connect();
			$query = "SELECT ";
			foreach ($cols as $col => $as) {
				$query.= ' `' . self::escape($col) . '`';
				if ($as) {
					$query.= ' AS `' . self::escape($as) . '`';
				}
				$query.= ',';
			}
			$query = trim($query, ',');
			$query.= ' FROM `' . self::escape($table) . '` WHERE `date_actual` >= now()';

			$res = mysqli_query(self::$connect, $query);
			$array = array();

			while($obj = mysqli_fetch_object($res)) {
				$array[] = $obj;
			}

			return $array;
		}

		public static function escape($val) {
			return mysqli_real_escape_string(self::$connect, $val);
		}

		public static function query($query){
			self::connect();
			$res = mysqli_query(self::$connect, $query);
			return mysqli_fetch_assoc($res);
		}

		public static function insert($table, $values) {
			self::connect();
			$cols = '';
			$vals = '';
			foreach ($values as $column => $value) {
				$cols.= "`" . self::escape($column) . "`,";
				$vals.= "'" . self::escape($value) . "',";
			}
			$cols  = trim($cols, ',');
			$vals  = trim($vals, ',');
			$query = "INSERT INTO `" . self::escape($table) . "` ($cols) VALUE ($vals);";

			mysqli_query(self::$connect, $query);
			return mysqli_insert_id(self::$connect);
		}

		public static function update($table, $values, $where) {
			self::connect();
			$query = 'UPDATE `' . self::escape($table) . '` SET ';
			foreach ($values as $column => $value) {
				$query.= '`' . self::escape($column) . '` = "' . self::escape($value) . '",';
			}
			$query = trim($query, ',');
			$query.= 'WHERE 1 ';
			foreach ($where as $col => $val) {
				$query.= ' AND `' . self::escape($col) . '` = "' . self::escape($val) . '"';
			}
			return mysqli_query(self::$connect, $query);
		}

		public static function delete($table, $where = array()) {
			self::connect();
			$query = 'DELETE FROM `' . self::escape($table) . '` WHERE 1 ';
			foreach ($where as $col => $val) {
				$query.= ' AND `' . self::escape($col) . '` = "' . self::escape($val) . '"';
			}

			return mysqli_query(self::$connect, $query);
		}
	}
