<?php 

	namespace Manager;

	class ChoristeManager extends \W\Manager\Manager{

		private function insertImage() {
			$alt_img = $_POST['alt'];
			$desc_img  = $_POST['desc_img'];

			$finfo = new \finfo(FILEINFO_MIME_TYPE);
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

		    $path = '../public/assets/img/' .date('d-m-Y-h-i-s'). '.' . $extFoundInArray;
			$moved = move_uploaded_file($_FILES['my-file']['tmp_name'], $path);
			if(!$moved) {
				echo 'Erreur lors de l\'enregistrement';
			}
			
		
			$sql = "INSERT INTO.$this->table.(`url`, `alt`, `description`) VALUES (:url, :alt, :descr);";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindValue(':url', $path);
			$stmt->bindValue(':alt', $alt_img);
			$stmt->bindValue(':descr', $desc_img);
			$stmt->execute();
			return $this->dbh->lastInsertId();
		}

		function insertActu() {

			$titre = $_POST['titre'];
			$description = $_POST['description'];
			
			$id_img = $this->ajoutImage();
			
			$sql = "INSERT INTO news (`titre`, `description`, `extrait`, `id_image`, `is_private`, `date`) VALUES (:titre, :description, :extrait, :id_img , 1, CURRENT_TIMESTAMP)";
			$stmt = $this->dbh->prepare($sql);
			$stmt->bindValue(':titre', $titre);
			$stmt->bindValue(':description', $description);
			$stmt->bindValue(':extrait', substr($description, 0, 200).'...');
			$stmt->bindValue(':id_img', $id_img);
			$stmt->execute();						
		}
	}
