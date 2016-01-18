<?php 

	namespace Manager;

	class ChoristeManager extends \W\Manager\Manager{
		function insertActu() {

			function AjoutImage() {
				
				$finfo = new finfo(FILEINFO_MIME_TYPE);
				// Récupération du Mime
				$mimeType = $finfo->file($_FILES['my-file']['tmp_name']);

				$extFoundInArray = array_search(
			        $mimeType,
			        array(
			            'jpg' => 'image/jpeg',
			            'png' => 'image/png',
			            'gif' => 'image/gif',
			            'bmp' => 'image/bmp'
			        )
			    );

			    if ($extFoundInArray === false) {
			    	echo 'Le fichier n\'est pas une image';
			    	//die();
			    }

			    $path = '../../public/assets/img/' .date_timestamp_get(). '.' . $extFoundInArray;
				$moved = move_uploaded_file($_FILES['my-file']['tmp_name'], $path);
				if(!$moved) {
					echo 'Erreur lors de l\'enregistrement';
				}
				
				$pdo = $this->dbh;
				$sql = "INSERT INTO images (`url`, `alt`, `description`) VALUES (NULL, :url, :alt, :descr);";
				$stmt = $pdo->prepare($sql);
				$stmt->bindValue(':url', $path);
				$stmt->bindValue(':alt', $alt_img);
				$stmt->bindValue(':descr', $desc_img);
				$stmt->execute();
				return $pdo->lastInsertId();
			}

			if(!empty($_POST)) {
				$titre = $_POST['titre'];
				$description = $_POST['description'];
				$alt_img = $_POST['alt'];
				$desc_img  = $_POST['desc_img'];
				$id_img = ajoutImage();

				$pdo = $this->dbh;
				$sql = "INSERT INTO news (`id`, `titre`, `description`, `extrait`, `id_image`, `is_private`, `date`) VALUES (NULL, ':titre', ':description', ':extrait', :id_img , 1, CURRENT_TIMESTAMP);";
				$stmt = $pdo->prepare($sql);
				$stmt->bindValue(':titre', $titre);
				$stmt->bindValue(':description', $description);
				$stmt->bindValue(':extrait', $description);
				$stmt->execute();
				return $stmt->fetchAll();			
			}

				


	}

	}
