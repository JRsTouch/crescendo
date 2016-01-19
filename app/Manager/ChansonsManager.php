<?php
	
	namespace Manager;

	class ChansonsManager extends \W\Manager\Manager {
		public function insert($data){
			parent::insert($data);
			return $this->dbh->lastInsertId();
		}
	}