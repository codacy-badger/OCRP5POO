<?php

namespace src\model;

use src\entity\Post;
use src\entity\Content;
use src\entity\User;
use src\entity\Contact;
use src\entity\Answer;
use src\entity\Comment;
use config\Parameter;


abstract class Manager
{
	private $database;

	protected function dbRequest($sql, $params = null)
	{
		if ($params == null) {
			$req = $this->dbConnect()->query($sql);
			return $req;
		}
		$req = $this->dbConnect()->prepare($sql, $params);
		return $req;
	}

	private function dbConnect()
	{
		if ($this->database == null) {
			$this->database = new \PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8',DB_USER,DB_PASS);
			$this->database->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
		}
		return $this->database;
	}
}

