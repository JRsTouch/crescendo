<?php

	namespace Controller;
 
	use \W\Controller\Controller;

	class ChoristesController extends Controller
	{		

		/**
		* Page d'accueil du coin choriste
		**/


		/**
		 * Definition initiale et gestion des permissions
		**/
		public function __construct(){
		
			$this->allowTo(['admin', 'choriste', 'chef', 'gestion', 'bureau']);

		}

				
		/**
		 * Acces en BDD, Table Options
		 * @return Array : Contenu Table Options
		**/
		public function getOptions(){

			$optionsManager = new \Manager\OptionsManager();
			$options = $optionsManager->findAll();
			$options[0]['copyrights']=explode(';',$options[0]['copyrights']);

			
			return $options;

		}

		/**
		 * Rendu d'une chanson en fonction des données user
		 * @param 
		 * @return Array : Contenu chanson à display. Envoi à view.
		**/
		public function chansons($id=0){
			$options = $this->getOptions();
			$user = $this->getuser();

			$chansonsManager = new \Manager\ChansonsManager();
			$chansons = $chansonsManager->findAll();

			if ($id>0) {
				$chanson = $chansonsManager->getSongBySection($id,$pupitre);
				$chanson['titre'] = ucwords(preg_replace('/[_]/',' ',$chanson['titre']));
			} else {
				$chanson = 0;
			}
			
			$data = array(
							'pupitre' => $user['pupitre'],
							'chanson' => $chanson
						);

			$layout = array(
							'name' => 'chansons',
							'user' => $user,
							'options' => $options,
							'chansons' => $chansons
							);
		

			$this->show('choristes/chansons',['data' => $data, 'layout'=> $layout]);
		}

		/**
		 * Ajout en BDD et Upload d'une Actu.
		 * Envoi à view.
		**/

		/**
		 * AJAX : Recuperation des données BDD : Calendars
		**/
		public function calendar(){

			$calendarManager = new \Manager\CalendarsManager();
			
			$calendarManager->findAllEvent();

		}

		/**
		 * Ajout en BDD et Upload d'une chanson
		 * 6 mp3, 6 ogg, 6 pdf par chanson.
		 * Gestion des étapes du formulaire ( 8 )
		 * 1	: Recupération du titre ( INSERT INTO chansons)
		 * 2	: Recuperation mp3,ogg,pdf des tutti ( INSERT INTO musiques + pdfs )
		 * 3-7	: Récupération mp3,ogg,pdf des différents pupitres ( UPDATE musiques + pdfs )
		 * 8	: Fin du formulaire
		 * envoi à view.
		**/
		public function chansons_Ajout($id=0, $update=false){
			// initialisation de variables 

			$title = "";
			$count = 0;
			$song_to_update = 0;

				// Valeur de $pupitre dépendant de l'étape du formulaire
			$pupitre = array(
				'2' => 'tutti',
				'3' => 'sop1',
				'4' => 'sop2',
				'5' => 'alto',
				'6' => 'tenor',
				'7' => 'basse',
				);


			
			// Recupération de la liste des chansons pour afficher dans le menu

			

			// Si on a pas renseigné update, on ajoute une chanson
			if ( $update == false ) {
			// Traitement des formulaires
				
					// Sans action de formulaire
				if ( !isset($_POST['submit']) ) {
					// On passe le compteur d'étape à 1
					$count = 1;
				} else {
					// Avec action du formulaire, le compteur dépend du value du submit précédent
					$count=$_POST['submit'];
				}

				// Si Etape 1 soumise ( INSERT INTO chansons )
				if ( isset($_POST['submit']) && $_POST['submit'] == '1') {
					// compteur d'étape passe à 2
					$count++;
					// traitement des données
					$_SESSION['song']['title'] = mb_strtolower(preg_replace('/[\s-]/','_',$_POST['title']));
					// envoi du compteur en SESSION
					$_SESSION['form_count'] = $count;

					//Ajout du Titre en BDD
					$chansonsManager = new \Manager\ChansonsManager();

					$choregraphy = filter_var(trim($_POST['choregraphy']), FILTER_VALIDATE_URL);
					$informations = trim($_POST['informations']);

					$dataSong = array(
									'titre'	=>	$_SESSION['song']['title'],
									'choregraphie' => $choregraphy,
									'informations' => $informations
								);				
					
					$_SESSION['song']['id']= $chansonsManager->insert($dataSong);//Recupération de l'ID de la chanson en SESSION

				// Si Etape 2 soumise ( INSERT INTO musiques + pdfs )
				} else if ( isset($_POST['submit']) && $_POST['submit'] == '2') {

					// Récupération du pupitre en fonction de l'étape du formulaire
					$current_pupitre = $pupitre[$_SESSION['form_count']];

					// Déclaration des variables
					$pathMp3 = "";
					$pathOgg = "";
					$pathPdf = "";

					// Partie upload Mp3

					$finfo = new \finfo(FILEINFO_MIME_TYPE);

					$mimeType = $finfo->file($_FILES['mp3_tutti']['tmp_name']);
					if ( preg_match('/mpeg/',$mimeType)) {
						// Normalisation de l'URL pour MP3
						$pathMp3 = 'assets/mp3/' .$_SESSION['song']['title'].'_'.$current_pupitre. '.mp3' ;
						$movedMp3 = move_uploaded_file($_FILES['mp3_tutti']['tmp_name'], $pathMp3);
						if(!$movedMp3) {
							echo 'Erreur lors de l\'enregistrement Mp3';
						}

					} else { $errors = true; }

					// Partie upload Ogg

					$finfo = new \finfo(FILEINFO_MIME_TYPE);

					$mimeType = $finfo->file($_FILES['ogg_tutti']['tmp_name']);
					
					
					if ( preg_match('/.*\/ogg$/',$mimeType) ) {
						// Normalisation de l'URL pour Ogg
						$pathOgg = 'assets/ogg/' .$_SESSION['song']['title'].'_'.$current_pupitre. '.ogg';
						$movedOgg = move_uploaded_file($_FILES['ogg_tutti']['tmp_name'], $pathOgg);
						if(!$movedOgg) {
							echo 'Erreur lors de l\'enregistrement Ogg';
						}
					} else { $errors = true; }
				 	
				 	// Ajout BDD Mp3 et OGG

					$musiquesManager = new \Manager\MusiquesManager();
					$dataSong = array(
									'mp3_'.$current_pupitre => '../../../'.$pathMp3,
									'ogg_'.$current_pupitre => '../../../'.$pathOgg,
									'id_chanson' => $_SESSION['song']['id']
						);

					$musiquesManager->insert($dataSong);

					// Partie  Upload PDF

					$finfo = new \finfo(FILEINFO_MIME_TYPE);

					$mimeType = $finfo->file($_FILES['pdf_tutti']['tmp_name']);
					if ( $mimeType == 'application/pdf') {
						// Normalisation de l'URL pour Pdf
						$pathPdf = 'assets/pdf/' .$_SESSION['song']['title'].'_'.$current_pupitre. '.pdf';
						$movedPdf = move_uploaded_file($_FILES['pdf_tutti']['tmp_name'], $pathPdf);
						if(!$movedPdf) {
							echo 'Erreur lors de l\'enregistrement Pdf';
						}
					} else { $errors = true; }

					// Ajout BDD PDF

					$pdfsManager = new \Manager\PdfsManager();
					$dataSong = array(
									'pdf_'.$current_pupitre => '../../../'.$pathPdf,
									'id_chanson' => $_SESSION['song']['id']
						);

					$pdfsManager->insert($dataSong);

					
					// Si il n'y a pas eu d'erreurs, on passe à l'étape 3 .

				    if (isset($errors)){

				    } else {

						$count++;
						$_SESSION['form_count'] = $count;

					}
					
				// Si Etape 3 à 7 soumise ( UPDATE musiques + pdfs )
				} else if ( isset($_POST['submit']) && $_POST['submit'] == $_SESSION['form_count']) {
					// Récupération du pupitre en fonction de l'étape du formulaire
					$current_pupitre = $pupitre[$_SESSION['form_count']];

					// Déclaration des variables
					$pathMp3 = "";
					$pathOgg = "";
					$pathPdf = "";

					// Partie upload Mp3

					$finfo = new \finfo(FILEINFO_MIME_TYPE);

					$mimeType = $finfo->file($_FILES['mp3_'.$current_pupitre]['tmp_name']);
					if ( preg_match('/mpeg/',$mimeType)) {
						// Normalisation de l'URL pour MP3
						$pathMp3 = 'assets/mp3/' .$_SESSION['song']['title'].'_'.$current_pupitre. '.mp3' ;
						$movedMp3 = move_uploaded_file($_FILES['mp3_'.$current_pupitre]['tmp_name'], $pathMp3);
						if(!$movedMp3) {
							echo 'Erreur lors de l\'enregistrement Mp3';
						}
					} else { $errors = true; }
					// Partie Upload Ogg

					$finfo = new \finfo(FILEINFO_MIME_TYPE);

					$mimeType = $finfo->file($_FILES['ogg_'.$current_pupitre]['tmp_name']);
					
					
					if ( preg_match('/.*\/ogg$/',$mimeType) ) {
						// Normalisation de l'URL pour Ogg
						$pathOgg = 'assets/ogg/' .$_SESSION['song']['title'].'_'.$current_pupitre. '.ogg';
						$movedOgg = move_uploaded_file($_FILES['ogg_'.$current_pupitre]['tmp_name'], $pathOgg);
						if(!$movedOgg) {
							echo 'Erreur lors de l\'enregistrement Ogg';
						}
					} else { $errors = true; }
				 	
				 	// Ajout BDD Mp3 et Ogg

					$musiquesManager = new \Manager\MusiquesManager();
					$dataSong = array(
									'mp3_'.$current_pupitre => '../../../'.$pathMp3,
									'ogg_'.$current_pupitre => '../../../'.$pathOgg,
									'id_chanson' => $_SESSION['song']['id']
						);

					$musiquesManager->updateMusiques($dataSong, $_SESSION['song']['id']);

					// Partie Upload Pdf

					$finfo = new \finfo(FILEINFO_MIME_TYPE);

					$mimeType = $finfo->file($_FILES['pdf_'.$current_pupitre]['tmp_name']);
					if ( $mimeType == 'application/pdf') {
						// Normalisation de l'URL pour Pdf
						$pathPdf = 'assets/pdf/' .$_SESSION['song']['title'].'_'.$current_pupitre. '.pdf';
						$movedPdf = move_uploaded_file($_FILES['pdf_'.$current_pupitre]['tmp_name'], $pathPdf);
						if(!$movedPdf) {
							echo 'Erreur lors de l\'enregistrement Pdf';
						}
					} else { $errors = true; }

					// Partie Ajout BDD Pdf
					$pdfsManager = new \Manager\PdfsManager();
					$dataSong = array(
									'pdf_'.$current_pupitre => '../../../'.$pathPdf,
									'id_chanson' => $_SESSION['song']['id']
						);

					$pdfsManager->updatePdfs($dataSong, $_SESSION['song']['id']);

					// Si il n'y a pas d'erreurs, on passe à l'étape suivante.
				    if (isset($errors)){

				    } else {

						$count++;
						$_SESSION['form_count'] = $count;

					}
				
				} 

			// Si on a renseigné update , on appelle la methode updateSong
			}else if ( $update==true ){
				$song_to_update = $this->updateSong($id);
			}

			$options = $this->getOptions();
			$user = $this->getuser();
			$chansonsManager = new \Manager\ChansonsManager();
			$updatechansons = $chansonsManager->findAll();
				// Données concernant la mise en page du layout ( feuilles de styles dynamiques, balises meta...)
			$layout = array(
							'name' => 'chansons_ajout',
							'user' => $user,
							'options' => $options,
							'update_chansons' => $updatechansons
							);
			$data = array(
							'count' => $count,
							'update' => $update,
							'song_to_update'=> $song_to_update
						);
			// On récupère apres le traitement la liste complète des chansons mises à jour 

			$this->show('choristes/chansons_ajout',['data' => $data, 'layout'=> $layout]);

		}

		public function updateSong($id){
			$chansonsManager = new \Manager\ChansonsManager();
			$song_to_update = $chansonsManager->find($id);
			if (isset($_POST['update'])){
				$data_to_update = array(
										'choregraphie'	=> filter_var(trim($_POST['choregraphy']), FILTER_VALIDATE_URL),
										'informations'	=> trim($_POST['informations']),
							);
				$id_to_update = (int)($_POST['song_id']) ;
				$chansonsManager->update($data_to_update, $id_to_update);
				return 'done' ;
			}
			
			return $song_to_update;
		}

		public function getActus() {
			
			$options = $this->getOptions();
			$user = $this->getuser();
			$actuManager = new \Manager\ActusManager;
			$actus = $actuManager->getAllActus();

			$data = array(
							'actus' => $actus
						);

			$layout = array(
							'name' => 'actus',
							'user' => $user,
							'options' => $options,
							);

			$this->show('choristes/actus', [ 'layout'=>$layout , 'data'=>$data]);
		}

		
		public function gestionContenu() {
			


			if(isset($_POST['documentsent'])) { //Si on soumet le formulaire #document
			
				$finfo = new \finfo(FILEINFO_MIME_TYPE);
				// Récupération du Mime pour vérifier s'il est répertorié dans la liste des fichiers autorisés
				$mimeType = $finfo->file($_FILES['document']['tmp_name']);

				$extFoundInArray = array_search(
			        $mimeType,
			        array(
			            'doc' => 'application/msword',
			            'xls' => 'application/excel',
			            'xls' => 'application/vnd.ms-excel',
			            'xls' => 'application/x-excel',
			            'xls' => 'application/x-msexcel',
			            'txt' => 'text/plain',
			            'odt' => 'application/vnd.oasis.opendocument.text',
			            'pdf' => 'application/pdf'
			        )
			    );

			    if ($extFoundInArray === false) { //Si le fichier envoyé n'est pas dans les types répertoriés
			    	echo 'Le fichier n\'est pas au bon format. Formats acceptés: .doc, .xls, .odt, .txt, .pdf';
			    	//die();
			    }


			    //On renomme le document et on l'envoie dans le bon dossier 
			    $path = '../public/assets/docs/' .mb_strtolower(preg_replace('/[\s-]/','_',$_POST['titre'])). '.' . $extFoundInArray;
				$moved = move_uploaded_file($_FILES['document']['tmp_name'], $path);
				if(!$moved) {
					echo 'Erreur lors de l\'enregistrement';
				}
				
				//Insertion en base de données avec le fichier renommé et le bon chemin pour l'appel en BackOffice
			    $url = '/docs/' .mb_strtolower(preg_replace('/[\s-]/','_',$_POST['titre'])). '.' . $extFoundInArray;
				$documentManager = new \Manager\DocumentsManager();
				$insertion = array (
						'titre'		  => $_POST['titre'],
						'description' => $_POST['description'],
						'url' 		  => $url
					);
				$documentManager->insert($insertion);

					echo "<p>votre formulaire a bien été envoyé !</p>";
					//Retour à la page d'accueil du coin choriste 
					$this->show('choristes/actus');

			} 

			if(isset($_POST['youtubesent'])) { //Si on soumet le formulaire #youtube

				$url = $_POST['url'];
				$description = $_POST['description'];
				$video = new \Manager\VideosManager;
				$video->InsertVideosUrl($url, $description);

				echo "<p>votre formulaire a bien été envoyé !</p>";
				//Retour à la page d'accueil du coin choriste 

				$this->show('choristes/actus');

			} 


			if(isset($_POST['imagesent'])) { //Si on soumet le formulaire #image
				/* Upload images */
				$alt_img = $_POST['alt'];
				$desc_img  = $_POST['desc_img'];

				$finfo = new \finfo(FILEINFO_MIME_TYPE);
				// Récupération du Mime
				$mimeType = $finfo->file($_FILES['image']['tmp_name']);

				$extFoundInArray = array_search(
			        $mimeType,
			        array(
			            'jpg' => 'image/jpeg',
			            'png' => 'image/png',
			            'gif' => 'image/gif',
			            'bmp' => 'image/bmp'
			        )
			    );

			    if ($extFoundInArray === false) { //Si le fichier envoyé n'est pas une image 
			    	echo 'Le fichier n\'est pas une image';
			    	//die();
			    }


			    //On renomme l'image et on l'envoie dans le bon dossier 
			    $path = '../public/assets/img/' .date('d-m-Y-h-i-s'). '.' . $extFoundInArray;
				$moved = move_uploaded_file($_FILES['image']['tmp_name'], $path);
				if(!$moved) {
					echo 'Erreur lors de l\'enregistrement';
				}
				
				//Insertion en base de données avec le fichier renommé et le bon chemin pour l'appel en FrontOffice
			    $path = '/img/' .date('d-m-Y-h-i-s'). '.' . $extFoundInArray;
				$imagesManager = new \Manager\ImagesManager();
				$id_img = $imagesManager->insertImage($path, $alt_img, $desc_img);
				echo "<p>votre formulaire a bien été envoyé !</p>";
					//Retour à la page d'accueil du coin choriste 
				$this->show('choristes/actus');

			} 

			if(isset($_POST['newssent'])) {
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

			    if ($extFoundInArray === false) { //Si le fichier envoyé n'est pas une image 
			    	echo 'Le fichier n\'est pas une image';
			    	//die();
			    }


			    //On renomme l'image et on l'envoie dans le bon dossier 
			    $path = '../public/assets/img/' .date('d-m-Y-h-i-s'). '.' . $extFoundInArray;
				$moved = move_uploaded_file($_FILES['my-file']['tmp_name'], $path);
				if(!$moved) {
					echo 'Erreur lors de l\'enregistrement';
				}
				
				//Insertion en base de données avec le fichier renommé et le bon chemin pour l'appel en FrontOffice
			    $path = '/img/' .date('d-m-Y-h-i-s'). '.' . $extFoundInArray;
				$imagesManager = new \Manager\ImagesManager();
				$id_img = $imagesManager->insertImage($path, $alt_img, $desc_img);

				
				if($_POST['table'] == 'Presse') { 
					//Pour rentrer un article de presse dans la table Presses
					$titre = $_POST['titre'];
					$description = $_POST['description'];

					$PressesManager = new \Manager\PressesManager();
					$PressesManager->insertArticle($titre, $description,$id_img);
					echo "<h2>votre formulaire a bien été envoyé !</h2>";
					$this->show('choristes/actus');

				} else if ($_POST['table'] == 'News'){
					//Pour rentrer une news dans la table news 
					$titre = $_POST['titre'];
					$description = $_POST['description'];
					if($_POST['private'] == '1') { 
						//Si la news n'est visible que pour les choristes en partie privée
						$private = 1;
					}	else if ($_POST['private'] == 0 ){ 
						//Si la news est visible en display FrontOffice
						$private = 0;
					}

					$NewsManager = new \Manager\NewsManager();
					$NewsManager->insertArticle($titre, $description,$id_img, $private);
					echo "<p>votre formulaire a bien été envoyé !</p>";
					//Retour à la page d'accueil du coin choriste 
					$this->show('choristes/actus'); //Si on soumet le formulaire #news
				} 
			} 

			$options = $this->getOptions();
			$user = $this->getuser();
			$layout = array(
							'name' => 'gestion_contenu',
							'user' => $user,
							'options' => $options,
							);
			$data = array();
			//Sinon on affiche la page de formulaire vierge avec le select
			$this->show('choristes/ajout_contenu', ['data' => $data, 'layout'=> $layout ]);  
		} 

		public function repetitions(){


			if(isset($_POST['sent'])){
				$event = array(
						'heure' => $_POST['heure'],
						'description' => $_POST['description'],
						'day' => substr($_POST['date'], 8, 2),
						'mounth' => substr($_POST['date'], 5, 2),
						'year' => substr($_POST['date'], 0, 4),
					);

				$calendarsManager = new \Manager\CalendarsManager();

				$calendarsManager->insert($event);
			}

			
			$options = $this->getOptions();
			$user = $this->getuser();
			
			$data = array();

			$layout = array(
							'name' => 'repetition',
							'user' => $user,
							'options' => $options,
							);

			$this->show('choristes/repetitions', ['data' => $data, 'layout'=> $layout ]);
		}

		public function event(){

			$calendarManager = new \Manager\CalendarsManager();
			
			echo json_encode($calendarManager->findAll());

		}

		public function membres(){

			
			$options = $this->getOptions();
			$user = $this->getuser();
			


			$usersManager = new \Manager\UsersManager();

			$membres = $usersManager->findAllOrder();

			$data = array(
							'membres'	=>	$membres
						);

			$layout = array(
							'name'		=>	'membres',
							'user'		=>	$user,
							'options'	=> $options,
							);



			$this->show('choristes/membres', ['data' => $data, 'layout'=> $layout ]);
		}

	}
