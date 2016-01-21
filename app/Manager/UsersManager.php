<?php 

	namespace Manager;

	class UsersManager extends \W\Manager\Manager{
		
		public function findAllOrder(){

			$sql = "SELECT * FROM " . $this->table ."  ORDER BY pupitre, username";

			$sth = $this->dbh->prepare($sql);
			$sth->execute();

			return $sth->fetchAll();

		}

	}
