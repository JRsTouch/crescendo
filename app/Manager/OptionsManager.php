<?php
	
	namespace Manager;

	class OptionsManager extends \W\Manager\Manager {
		public function getBDDheader() {
			$pdo = $this->dbh;
			$sql = "SELECT titre, url_logo FROM  options WHERE id = :id";
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':id', 1);
			$stmt->execute();
			return $stmt->fetchAll();
		}
	}