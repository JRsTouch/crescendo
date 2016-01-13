<?php 

	namespace Manager;

	class NewsManager extends \W\Manager\Manager{
			public function getLastNews()
			{
				
				$sql = "SELECT * FROM " . $this->table . " ORDER BY date DESC LIMIT 9";
				$sth = $this->dbh->prepare($sql);
				$sth->execute();

				return $sth->fetchAll();
			}
	}