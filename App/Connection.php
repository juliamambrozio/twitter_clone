<?php

namespace App;

class Connection {

	public static function getDb() {
		try {

			$conn = new \PDO(
				"mysql:host=localhost;dbname=twitter_clone;charset=utf8",
				"root",
				"julia9122" 
			);

			return $conn;

		} catch (\PDOException $e) {
			//.. tratar de alguma forma ..//
		}
	}
}

?>