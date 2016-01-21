<?php 

	namespace Manager;

	class ActusManager extends \W\Manager\Manager
	{
		public function getAllActus() {
			$pdo = $this->dbh;
			$sql = "SELECT * FROM news ORDER BY date DESC";
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		}
	}
			