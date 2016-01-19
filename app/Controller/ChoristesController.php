<?php

	namespace Controller;
 
	use \W\Controller\Controller;

	class ChoristesController extends Controller
	{		

		/**
		 * Page d'accueil du coin choriste
		 */

		public function __construct(){
		
			$this->allowTo(['admin', 'user']);

		}
		
		public function home()
		{
			
			$data = array();
			$data['options'] = $this->getOptions();
			$layout = array();
			$this->show('choristes/home',['data' => $data, 'layout'=> $layout ]);
		}

		public function getOptions(){

			$optionsManager = new \Manager\OptionsManager();
			$options = $optionsManager->findAll();
			$options[0]['copyrights']=explode(';',$options[0]['copyrights']);

			
			return $options;
		}

		public function chansons(){
			
		}

		public function addNewsActus(){
			if(isset($_POST['sent'])) {

				/* Upload images */
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
				
			    $path = '/img/' .date('d-m-Y-h-i-s'). '.' . $extFoundInArray;
				$imagesManager = new \Manager\ImagesManager();
				$id_img = $imagesManager->insertImage($path, $alt_img, $desc_img);

				if($_POST['table'] == 'Presse') {

					$titre = $_POST['titre'];
					$description = $_POST['description'];

					$PressesManager = new \Manager\PressesManager();
					$PressesManager->insertArticle($titre, $description,$id_img);
					echo "<h2>votre formulaire a bien été envoyé !</h2>";
					$this->show('choristes/home');

				} else if ($_POST['table'] == 'News'){

					$titre = $_POST['titre'];
					$description = $_POST['description'];

					$NewsManager = new \Manager\NewsManager();
					$NewsManager->insertArticle($titre, $description,$id_img);
					echo "<h2>votre formulaire a bien été envoyé !</h2>";
					$this->show('choristes/home');
				} 
			}
				
			$this->show('choristes/ajout_news');
		}
	}
