<?php 

	namespace Manager;

	class PresseManager extends \W\Manager\Manager{
		public function getLastPresse()
			{
				
				$sql = "SELECT * FROM " . $this->table . " ORDER BY date DESC LIMIT 9";
				$sth = $this->dbh->prepare($sql);
				$sth->execute();

				return $sth->fetchAll();
			}
	}