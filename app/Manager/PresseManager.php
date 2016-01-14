<?php 

	namespace Manager;

	class PresseManager extends \W\Manager\Manager{
		public function getLastPresse()
			{
				$presse = $this->table;
				$sql = "SELECT * FROM $presse LEFT JOIN images ON $presse.id_image = images.id ORDER BY date DESC LIMIT 9";
				$sth = $this->dbh->prepare($sql);
				$sth->execute();

				return $sth->fetchAll();
			}
	}