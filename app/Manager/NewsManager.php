<?php 

	namespace Manager;

	class NewsManager extends \W\Manager\Manager{
			public function getLastNews()
			{
				$news = $this->table;
				$sql = "SELECT * FROM $news LEFT JOIN images ON $news.id_image = images.id ORDER BY date DESC LIMIT 9";
				$sth = $this->dbh->prepare($sql);
				$sth->execute();

				return $sth->fetchAll();
			}
	}