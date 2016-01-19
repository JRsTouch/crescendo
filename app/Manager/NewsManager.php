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

			function insertArticle($titre, $description,$id_img) {
								
				$sql = "INSERT INTO news (`titre`, `description`, `extrait`, `id_image`, `is_private`, `date`) VALUES (:titre, :description, :extrait, :id_img , 1, CURRENT_TIMESTAMP)";
				$stmt = $this->dbh->prepare($sql);
				$stmt->bindValue(':titre', $titre);
				$stmt->bindValue(':description', $description);
				$stmt->bindValue(':extrait', substr($description, 0, 200).'...');
				$stmt->bindValue(':id_img', $id_img);
				$stmt->execute();						
		}

	}