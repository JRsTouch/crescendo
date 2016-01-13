<?php 

	namespace Manager;

	class ImagesManager extends \W\Manager\Manager{

			public function getLastImages()
			{
				
				$sql = "SELECT * FROM " . $this->table . " ORDER BY id DESC LIMIT 9";
				$sth = $this->dbh->prepare($sql);
				$sth->execute();

				return $sth->fetchAll();
			}
	}