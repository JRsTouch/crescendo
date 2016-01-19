<?php 

	namespace Manager;

	class PressesManager extends \W\Manager\Manager{
		public function getLastPresses()
			{
				$presses = $this->table;
				$sql = "SELECT * FROM $presses LEFT JOIN images ON $presses.id_image = images.id ORDER BY date DESC LIMIT 9";
				$sth = $this->dbh->prepare($sql);
				$sth->execute();

				return $sth->fetchAll();
			}

		public function getAllPresses() 
		{	
			$pdo = $this->dbh;
			$sql = "SELECT * FROM presses ORDER BY date DESC";
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		}


		function insertArticle($titre, $description,$id_img) {

			$sql = "INSERT INTO presses (`titre`, `description`, `extrait`, `id_image`, `date`) VALUES (:titre, :description, :extrait, :id_img , CURRENT_TIMESTAMP)";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindValue(':titre', $titre);
			$stmt->bindValue(':description', $description);
			$stmt->bindValue(':extrait', substr($description, 0, 200).'...');
			$stmt->bindValue(':id_img', $id_img);
			$stmt->execute();						
		}
	}