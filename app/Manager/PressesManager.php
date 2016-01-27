<?php 

	namespace Manager;

	class PressesManager extends \W\Manager\Manager{

		/**
	 	* Va chercher les derniers articles de presses et les images qui y sont liées en clé étrangère dans la BDD  
	 	* @return (array)
	 	*/
		public function getLastPresses()
			{
				$presses = $this->table;
				$sql = "SELECT * FROM $presses LEFT JOIN images ON $presses.id_image = images.id ORDER BY date DESC LIMIT 9";
				$sth = $this->dbh->prepare($sql);
				$sth->execute();

				return $sth->fetchAll();
			}


		/**
	 	* Va chercher tout le contenu des articles de presses dans la BDD  
	 	* @return (array)
	 	*/
		public function getAllPresses() 
		{	
			$pdo = $this->dbh;
			$presses = $this->table;
			$sql = "SELECT * FROM $presses LEFT JOIN images ON $presses.id_image = images.id ORDER BY date DESC ";
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		}


		/**
		 * Récupérer les enregistrements BDD avec offset et limite dynamique 
		 *@param premiereEntree: offset calculé dynamiquement, première entrée de la page à lire
		 *@param articleParPage: limite imposée par le nombre d'articles display dans la partie actu
		 */
		public function getAllPressesPagination($premiereEntree, $articlesParPage) 
		{	
			$pdo = $this->dbh;
			$presses = $this->table;
			$sql = "SELECT presses.id, presses.titre, presses.extrait, presses.id_image, images.url, date, 'presses' as type FROM presses LEFT JOIN images ON presses.id_image = images.id " .
					" UNION SELECT news.id, news.titre, news.extrait, news.id_image, images.url, date, 'news' as type FROM news LEFT JOIN images ON news.id_image = images.id LIMIT $articlesParPage OFFSET $premiereEntree";
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		/**
		 * Récupérer le nombre d'enregistrements d'articles de presse en database pour gérer la pagination sur la page actu 
		 */
		public function countPresses() {
			$pdo = $this->dbh;
			$sql = "SELECT COUNT(*) AS nombre_articles FROM presses";
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		}


		/**
		* Insère le contenu du formulaire de la page /choristes/ajout_news en BackOffice et insère les données correspondantes dans la table Presses 
		* @param titre : le titre de l'article de presse 
		* @param description: le contenu de l'article'
		* @param id_img: id_img est un paramètre qui vient d'une autre fonction (Image#InsertImage) et qui est une clé étrangère 
 		*/
		public function insertArticle($titre, $description,$id_img) {

			$sql = "INSERT INTO presses (`titre`, `description`, `extrait`, `id_image`, `date`) VALUES (:titre, :description, :extrait, :id_img , CURRENT_TIMESTAMP)";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindValue(':titre', $titre);
			$stmt->bindValue(':description', $description);
			$stmt->bindValue(':extrait', substr($description, 0, 200).'...');
			$stmt->bindValue(':id_img', $id_img);
			$stmt->execute();						
		}


		/**
		* Récupère les données croisées de la table presses et images dans un tableau 
		* @param id: ID passé en URL 
		*@return tableau associatif avec tous les enregistrements  
 		*/
		public function getPressesById($id) 
		{	
			$pdo = $this->dbh;
			$sql = "SELECT presses.titre as newstitre, presses.description as newsdesc, id_image, images.url as img_url, date FROM presses LEFT JOIN images ON presses.id_image = images.id WHERE presses.id =:id";
			$stmt = $pdo->prepare($sql);
			$stmt->bindValue(':id', $id);
			$stmt->execute();
			return $stmt->fetchAll();
		}
	}