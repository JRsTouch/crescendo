<?php 

	namespace Manager;

	class ImagesManager extends \W\Manager\Manager{


			/**
			 * Récupère les 9 dernières images enregistrées en BDD
			 * @return images(array)
			 */
			public function getLastImages()
			{
				$sql = "SELECT * FROM " . $this->table . " ORDER BY id DESC LIMIT 9";
				$sth = $this->dbh->prepare($sql);
				$sth->execute();

				return $sth->fetchAll();
			}


			/**
			 * Insère l'image du formulaire de la page /choristes/ajout_news dans la table correspondante 
			 * @param path : le lien généré par Choriste#addNewsActus qui renomme le fichier soumis et le déplace dans le dossier public/assets/img
			 * @param alt_img : l'alt rempli par l'utilisateur pour son le rendu html 
			 * @param desc_img: description sommaire de l'image pour son affichage sur la page dédiée
			 * @return le dernier ID de l'image insérée pour son utilisation dans le Choriste#AddNewsActus 
			 */
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