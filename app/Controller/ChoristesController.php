<?php

	namespace Controller;
 
	use \W\Controller\Controller;

	class ChoristesController extends Controller
	{		

		/**
		 * Page d'accueil du coin choriste
		 */

		public function __construct(){
		
			$this->allowTo(['admin', 'choriste', 'chef', 'gestion', 'bureau']);

		}
		
		public function home(){
	
			$data = array();
			$data['options'] = $this->getOptions();
			$data['user'] = $this->getuser();
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

		public function calendar(){

			$calendarManager = new \Manager\CalendarsManager();
			
			$calendarManager->findAll();

		}

		public function chansons_Ajout(){
			// Définition de variables 

				// Titre de la chanson
			$title = "";
				// Données à envoyer au layout
			$data = array();
				// Données concernant la mise en page du layout ( feuilles de styles dynamiques, balises meta...)
			$layout = array();
				// Valeur de $pupitre dépendant de l'étape du formulaire
			$pupitre = array(
				'2' => 'tutti',
				'3' => 'sop1',
				'4' => 'sop2',
				'5' => 'alto',
				'6' => 'tenor',
				'7' => 'basse',
				);

				// Recupère les données à afficher dans le footer
			$data['options'] = $this->getOptions();
			

			// Traitement des formulaires

				// Sans action de formulaire
			if ( !isset($_POST['submit']) ) {
				// On passe le compteur d'étape à 1
				$count = 1;
			} else {
				// Avec action du formulaire, le compteur dépend du value du submit précédent
				$count=$_POST['submit'];
			}
			if ( isset($_POST['submit']) && $_POST['submit'] == '1') {

				$count++;
				$_SESSION['song']['title'] = mb_strtolower(preg_replace('/[\s-]/','_',$_POST['title']));
				$_SESSION['form_count'] = $count;

				$chansonsManager = new \Manager\ChansonsManager();

				$data = array(
								'titre'	=>	$_SESSION['song']['title'],
							);

				
				
				$_SESSION['song']['id']= $chansonsManager->insert($data);

			} else if ( isset($_POST['submit']) && $_POST['submit'] == '2') {

				$current_pupitre = $pupitre[$_SESSION['form_count']];

				
				$pathMp3 = "";
				$pathOgg = "";
				$pathPdf = "";

				// MP3

				$finfo = new \finfo(FILEINFO_MIME_TYPE);

				$mimeType = $finfo->file($_FILES['mp3_tutti']['tmp_name']);
				if ( preg_match('/mpeg/',$mimeType)) {
					$pathMp3 = '../public/assets/mp3/' .$_SESSION['song']['title'].'_'.$current_pupitre. '.mp3' ;
					$movedMp3 = move_uploaded_file($_FILES['mp3_tutti']['tmp_name'], $pathMp3);
					if(!$movedMp3) {
						echo 'Erreur lors de l\'enregistrement Mp3';
					}
				} else { $errors = true; }
				// OGG

				$finfo = new \finfo(FILEINFO_MIME_TYPE);

				$mimeType = $finfo->file($_FILES['ogg_tutti']['tmp_name']);
				
				
				if ( preg_match('/.*\/ogg$/',$mimeType) ) {
					$pathOgg = '../public/assets/ogg/' .$_SESSION['song']['title'].'_'.$current_pupitre. '.ogg';
					$movedOgg = move_uploaded_file($_FILES['ogg_tutti']['tmp_name'], $pathOgg);
					if(!$movedOgg) {
						echo 'Erreur lors de l\'enregistrement Ogg';
					}
				} else { $errors = true; }
			 	
			 	// Ajout BDD 

				$musiquesManager = new \Manager\MusiquesManager();
				$data = array(
								'mp3_'.$current_pupitre => $pathMp3,
								'ogg_'.$current_pupitre => $pathOgg,
								'id_chanson' => $_SESSION['song']['id']
					);

				$musiquesManager->insert($data);

				// Partie PDF

				$finfo = new \finfo(FILEINFO_MIME_TYPE);

				$mimeType = $finfo->file($_FILES['pdf_tutti']['tmp_name']);
				if ( $mimeType == 'application/pdf') {
					$pathPdf = '../public/assets/pdf/' .$_SESSION['song']['title'].'_'.$current_pupitre. '.pdf';
					$movedPdf = move_uploaded_file($_FILES['pdf_tutti']['tmp_name'], $pathPdf);
					if(!$movedPdf) {
						echo 'Erreur lors de l\'enregistrement Pdf';
					}
				} else { $errors = true; }

				$pdfsManager = new \Manager\PdfsManager();
				$data = array(
								'pdf_'.$current_pupitre => $pathPdf,
								'id_chanson' => $_SESSION['song']['id']
					);

				$pdfsManager->insert($data);

			
			    if (isset($errors)){

			    } else {

					$count++;
					$_SESSION['form_count'] = $count;

				}
				

			} else if ( isset($_POST['submit']) && $_POST['submit'] == $_SESSION['form_count']) {
				$current_pupitre = $pupitre[$_SESSION['form_count']];

				
				$pathMp3 = "";
				$pathOgg = "";
				$pathPdf = "";

				// MP3

				$finfo = new \finfo(FILEINFO_MIME_TYPE);

				$mimeType = $finfo->file($_FILES['mp3_'.$current_pupitre]['tmp_name']);
				if ( preg_match('/mpeg/',$mimeType)) {
					$pathMp3 = '../public/assets/mp3/' .$_SESSION['song']['title'].'_'.$current_pupitre. '.mp3' ;
					$movedMp3 = move_uploaded_file($_FILES['mp3_'.$current_pupitre]['tmp_name'], $pathMp3);
					if(!$movedMp3) {
						echo 'Erreur lors de l\'enregistrement Mp3';
					}
				} else { $errors = true; }
				// OGG

				$finfo = new \finfo(FILEINFO_MIME_TYPE);

				$mimeType = $finfo->file($_FILES['ogg_'.$current_pupitre]['tmp_name']);
				
				
				if ( preg_match('/.*\/ogg$/',$mimeType) ) {
					$pathOgg = '../public/assets/ogg/' .$_SESSION['song']['title'].'_'.$current_pupitre. '.ogg';
					$movedOgg = move_uploaded_file($_FILES['ogg_'.$current_pupitre]['tmp_name'], $pathOgg);
					if(!$movedOgg) {
						echo 'Erreur lors de l\'enregistrement Ogg';
					}
				} else { $errors = true; }
			 	
			 	// Ajout BDD 

				$musiquesManager = new \Manager\MusiquesManager();
				$data = array(
								'mp3_'.$current_pupitre => $pathMp3,
								'ogg_'.$current_pupitre => $pathOgg,
								'id_chanson' => $_SESSION['song']['id']
					);

				$musiquesManager->updateMusiques($data, $_SESSION['song']['id']);

				// Partie PDF

				$finfo = new \finfo(FILEINFO_MIME_TYPE);

				$mimeType = $finfo->file($_FILES['pdf_'.$current_pupitre]['tmp_name']);
				if ( $mimeType == 'application/pdf') {
					$pathPdf = '../public/assets/pdf/' .$_SESSION['song']['title'].'_'.$current_pupitre. '.pdf';
					$movedPdf = move_uploaded_file($_FILES['pdf_'.$current_pupitre]['tmp_name'], $pathPdf);
					if(!$movedPdf) {
						echo 'Erreur lors de l\'enregistrement Pdf';
					}
				} else { $errors = true; }

				$pdfsManager = new \Manager\PdfsManager();
				$data = array(
								'pdf_'.$current_pupitre => $pathPdf,
								'id_chanson' => $_SESSION['song']['id']
					);

				$pdfsManager->updatePdfs($data, $_SESSION['song']['id']);

			
			    if (isset($errors)){

			    } else {

					$count++;
					$_SESSION['form_count'] = $count;

				}

			}
			$this->show('choristes/chansons_ajout',['count'=>$count, 'data' => $data, 'layout'=> $layout]);

		}

	}
