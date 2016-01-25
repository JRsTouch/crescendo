<?php 

	namespace Manager;

	class NewsManager extends \W\Manager\Manager{

		/**
		 * Récupère les 9 derniers enregistrements de la table news (publics) et les images qui y sont liées en clé étrangères
		*/
		public function getLastNews()
		{
			$news = $this->table;
			$sql = "SELECT * FROM news LEFT JOIN images ON news.id_image = images.id WHERE is_private = 0 ORDER BY date DESC LIMIT 9";
			//Ne renvoie que les news publiques (les privées sont indiquées en is_private = 1 )
			$sth = $this->dbh->prepare($sql);
			$sth->execute();

			return $sth->fetchAll();
		}


		/**
		 * Insère le contenu de la news du formulaire de la page /choristes/ajout_news dans la table correspondante 
		 * @param titre : le titre de la news
		 * @param description: le contenu de la news 
		 * @param id_img: id de l'image correspondante, clé étrangère générée par le return de la fonction insertImage de ImagesManager 
		 * @param private: booléen qui signale que la news ne peut pas être display dans le front
		 */
		public function insertArticle($titre, $description,$id_img, $private) {
							
			$sql = "INSERT INTO news (`titre`, `description`, `extrait`, `id_image`, `is_private`, `date`) VALUES (:titre, :description, :extrait, :id_img , :private, CURRENT_TIMESTAMP)";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindValue(':titre', $titre);
			$stmt->bindValue(':description', $description);
			$stmt->bindValue(':extrait', substr($description, 0, 200).'...');
			$stmt->bindValue(':id_img', $id_img);
			$stmt->bindValue(':private', $private);
			$stmt->execute();						
		}

		public function getAllNews() { //Récupérer toutes les news sans distinction pour affichage en partie privée 
			$sql = "SELECT news.titre, news.description, news.extrait, images.url, images.description FROM news LEFT JOIN images ON id_image=images.id";
			$stmt = $this->dbh->prepare($sql);
			$stmt->execute();
			return $stmt->fetchAll();
		}

		public function countNews() {
		$pdo = $this->dbh;
		$sql = "SELECT COUNT(*) AS nombre_news FROM news";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();;
		}

		public function getAllNewsPagination($premiereEntree, $articleParPage) 
		{	
		$pdo = $this->dbh;
		$presses = $this->table;
		$sql = "SELECT * FROM news LEFT JOIN images ON news.id_image = images.id ORDER BY news.id DESC LIMIT $premiereEntree , $articleParPage";
		$stmt = $pdo->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll();
		}

	}