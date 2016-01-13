<?php 

	namespace Manager;

	class PicturesManager extends \W\Manager\Manager{

			public function getLastPictures()
			{
				
				$sql = "SELECT * FROM " . $this->table . " ORDER BY date DESC LIMIT 9";
				$sth = $this->dbh->prepare($sql);
				$sth->execute();

				return $sth->fetchAll();
			}
	}