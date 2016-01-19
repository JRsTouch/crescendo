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

			public function insertImage($path, $alt_img, $desc_img) {
			
				$sql = "INSERT INTO images (`url`, `alt`, `description`) VALUES (:url, :alt, :descr);";
				$stmt = $this->dbh->prepare($sql);
				$stmt->bindValue(':url', $path);
				$stmt->bindValue(':alt', $alt_img);
				$stmt->bindValue(':descr', $desc_img);
				$stmt->execute();

				return $this->dbh->lastInsertId();
		}
	}