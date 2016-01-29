<?php

	namespace Controller;
 
	use \W\Controller\Controller;

	class ChoristesController extends Controller
	{		

		/**
		* Page d'accueil du coin choriste : private
		**/


		/**
		 * Definition initiale et gestion des permissions
		**/
		public function __construct(){
		
			$this->allowTo(['admin', 'choriste', 'chef', 'gestion', 'bureau']);

		}

				
		/**
		 * Acces en BDD, Table Options
		 * @return array : Contenu Table Options
		**/
		public function getOptions(){

			$optionsManager = new \Manager\OptionsManager();
			$options = $optionsManager->findAll();
			$options[0]['copyrights']=explode(';',$options[0]['copyrights']);

			
			return $options[0]['copyrights'];//a garder

		}


		/**
		 * Rendu d'une chanson en fonction des données user 
		 * @return array : Contenu chanson à display. Envoi à view.
		**/
		public function chansons($id=0){
			$options = $this->getOptions();
			$user = $this->getuser();

			$chansonsManager = new \Manager\ChansonsManager();
			$chansons = $chansonsManager->findAll();

			$data = array(
							'pupitre' => $user['pupitre'],
							'chanson' => ''
						);

			if ($id>0) {
				$chanson = $chansonsManager->getSongBySection($id,$data['pupitre']);
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
							'chansons' => $chansons,
							'tags'		=>	array(
												'link'		=> array(
																			'css/chansons.css',
																	),
												'script'	=> array(
																			'js/song.js',
																	),
												
											),
							);
		

			$this->show('choristes/chansons',['data' => $data, 'layout'=> $layout]);

		}


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
		 * @param id, celle de la chanson, update, verifie si on a faitr la mise a jour ou pas .
		 * renvoie envoi à view.
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
							'update_chansons' => $updatechansons,
							'tags'		=>	array(
												'link'		=> array(
																			'css/chansons_ajout.css',
																	),												
											),
							);
			$data = array(
							'count' => $count,
							'update' => $update,
							'song_to_update'=> $song_to_update
						);
			// On récupère apres le traitement la liste complète des chansons mises à jour 

			$this->show('choristes/chansons_ajout',['data' => $data, 'layout'=> $layout]);

		}


		/**
		 * Mise à jour du lien youtube de la chanson, et des informations la concernant.
		 * @param id, celle de la chanson à update.
		 * @return indicateur d'execution de l'update.
		**/
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


		/**
		 * récuperation des articles et news dans leur ordre d'ajout, et paginé
		 * Renvoie contenu paginé
		**/
		public function getActus(){

			$NbArticles = new \Manager\PressesManager;
			$Nb = $NbArticles->countPresses(); //Renvoie le nombre d'enregistrements de la table Presses
			$NbNews = new \Manager\NewsManager;
			$NbN = $NbNews->countNews();

			$articlesParPage = 5;
			$total=$Nb[0]['nombre_articles'] + $NbN[0]['nombre_news'];
			$nombreDePages=ceil($total/$articlesParPage);


			if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
			{
			     $pageActuelle=intval($_GET['page']);

			     if($pageActuelle>$nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
			     {
			          $pageActuelle=$nombreDePages;
			     }
			}
			else // Sinon
			{
			     $pageActuelle=$nombreDePages; // La page actuelle est la n°1
			}

			$premiereEntree=($pageActuelle-1)*$articlesParPage; // On calcule la première entrée à lire


			$pagination = new \Manager\PressesManager;
			$pages = $pagination->getAllPressesPagination($premiereEntree, $articlesParPage);

			function array_sort($array, $key)
			{
  			for ($i = 0; $i < sizeof($array); $i++) {
      			$sort_values[$i] = $array[$i][$key];
  			}

  			asort  ($sort_values);
  			reset ($sort_values);
 
  			while (list ($arr_key, $arr_val) = each ($sort_values)) {
      			$sorted_arr[] = $array[$arr_key];
 			}
 			unset($array);
  			return $sorted_arr;
			}


			$pages = array_sort($pages,'date');
			$pages = array_reverse ( $pages );
			$options = $this->getOptions();
			$user = $this->getuser();


			$data = array(
							'Nb'			  => $Nb,
							'pages'			  => $pages,
							'total'			  => $total,
							'nombreDePages'   => $nombreDePages,
							'articlesParPages' => $articlesParPage
						);

			$layout = array(
							'name' => 'actus',
							'user' => $user,
							'options' => $options,														
							);


			$this->show('choristes/actus', [ 'data' => $data, 'layout' => $layout ]);

		}

		
		/**
		 * Upload et ajout en BDD en fonction du type de contenu.
		 * Retour sur page d'ajout de contenu quand terminé.
		**/
		public function gestionContenu(){
			
			$options = $this->getOptions();
			$user = $this->getuser();
			$data = array();


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

					$layout = array(
							'name' => 'actus',
							'user' => $user,
							'options' => $options,
							'tags'		=>	array(												
												'script'	=> array(
																			'js/contenu.js',
																	),
												
											),
							);
					$this->show('choristes/ajout_contenu', ['layout'=> $layout, 'upload'=>true]);


			} 

			if(isset($_POST['youtubesent'])) { //Si on soumet le formulaire #youtube

				$url = $_POST['url'];
				$description = $_POST['description'];
				$video = new \Manager\VideosManager;
				$video->InsertVideosUrl($url, $description);

				$layout = array(
							'name' => 'actus',
							'user' => $user,
							'options' => $options,
							'tags'		=>	array(												
												'script'	=> array(
																			'js/contenu.js',
																	),
												
											),
							);

				$this->show('choristes/ajout_contenu', ['layout'=> $layout, 'upload'=>true]);

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
			        )
			    );

			    if ($extFoundInArray === false) { //Si le fichier envoyé n'est pas une image 
			    	echo 'Le fichier n\'est pas une image';
			    	//die();
			    }

			    $timestamp = date('d-m-Y-h-i-s');
			    //On renomme l'image et on l'envoie dans le bon dossier 
			    $path = '../public/assets/img/' .$timestamp. '.' . $extFoundInArray;
				$moved = move_uploaded_file($_FILES['image']['tmp_name'], $path);
				if(!$moved) {
					echo 'Erreur lors de l\'enregistrement';
				}

				// création de la thumbnail
				$filename = '../public/assets/img/' .$timestamp. '-thumb.' . $extFoundInArray;
				$newwidth = 150;

				// Calcul des nouvelles dimensions
				list($width, $height) = getimagesize($path);
				$newheight = ($height * $newwidth) / $width;

				// Chargement
				$thumb = imagecreatetruecolor($newwidth, $newheight);

				if($mimeType == 'image/jpeg'){
					$source = imagecreatefromjpeg($path);
					imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					imagejpeg($thumb, $filename);
				}

				if($mimeType == 'image/png'){
					$source = imagecreatefrompng($filename);
					imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					imagepng($thumb, $filename);
				}
				
				//Insertion en base de données avec le fichier renommé et le bon chemin pour l'appel en FrontOffice
			    $path = 'img/' .$timestamp. '.' . $extFoundInArray;
				$imagesManager = new \Manager\ImagesManager();
				$id_img = $imagesManager->insertImage($path, $alt_img, $desc_img);
				
					
				$layout = array(
							'name' => 'actus',
							'user' => $user,
							'options' => $options,
							'tags'		=>	array(												
												'script'	=> array(
																			'js/contenu.js',
																	),
												
											),
							);

				$this->show('choristes/ajout_contenu', ['layout'=> $layout, 'upload'=>true]);

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
			        )
			    );

			    if ($extFoundInArray === false) { //Si le fichier envoyé n'est pas une image 
			    	echo 'Le fichier n\'est pas une image';
			    	//die();
			    }

			    $timestamp = date('d-m-Y-h-i-s');
			    //On renomme l'image et on l'envoie dans le bon dossier 
			    $path = '../public/assets/img/' .$timestamp. '.' . $extFoundInArray;
				$moved = move_uploaded_file($_FILES['my-file']['tmp_name'], $path);
				if(!$moved) {
					echo 'Erreur lors de l\'enregistrement';
				}

				// création de la thumbnail
				$filename = '../public/assets/img/' .$timestamp. '-thumb.' . $extFoundInArray;
				$newwidth = 150;

				// Calcul des nouvelles dimensions
				list($width, $height) = getimagesize($path);
				$newheight = ($height * $newwidth) / $width;

				// Chargement
				$thumb = imagecreatetruecolor($newwidth, $newheight);

				if($mimeType == 'image/jpeg'){
					$source = imagecreatefromjpeg($path);
					imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					imagejpeg($thumb, $filename);
				}

				if($mimeType == 'image/png'){
					$source = imagecreatefrompng($filename);
					imagecopyresampled($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
					imagepng($thumb, $filename);
				}
				
				//Insertion en base de données avec le fichier renommé et le bon chemin pour l'appel en FrontOffice
			    $path = 'img/' .$timestamp. '.' . $extFoundInArray;
				$imagesManager = new \Manager\ImagesManager();
				$id_img = $imagesManager->insertImage($path, $alt_img, $desc_img);

				
				if($_POST['table'] == 'Presse') { 
					//Pour rentrer un article de presse dans la table Presses
					$titre = $_POST['titre'];
					$description = $_POST['description'];
					$PressesManager = new \Manager\PressesManager;
					$PressesManager->insertArticle($titre, $description,$id_img);

					$layout = array(
							'name' => 'actus',
							'user' => $user,
							'options' => $options,
							'tags'		=>	array(												
												'script'	=> array(
																			'js/contenu.js',
																	),
												
											),
							);

					$this->show('choristes/ajout_contenu', ['layout'=> $layout, 'upload'=>true]);


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

					$NewsManager = new \Manager\NewsManager;
					$NewsManager->insertArticle($titre, $description,$id_img, $private);
					
					$layout = array(
							'name' => 'actus',
							'user' => $user,
							'options' => $options,
							'tags'		=>	array(												
												'script'	=> array(
																			'js/contenu.js',
																	),
												
											),
							);

					$this->show('choristes/ajout_contenu', ['layout'=> $layout, 'upload'=>true]);


				} 
			} 

			$options = $this->getOptions();
			$user = $this->getuser();
			$layout = array(
							'name' => 'gestion_contenu',
							'user' => $user,
							'options' => $options,
							'tags'		=>	array(												
												'script'	=> array(
																			'js/contenu.js',
																	),
												
											),
							);
			
			//Sinon on affiche la page de formulaire vierge avec le select
			$this->show('choristes/ajout_contenu', ['data' => $data, 'layout'=> $layout ]);  
		} 


		/**
		 * Ajout d'un evenement dans le calendrier, en fonction d'une date
		 * @param $_POSt, contiens les information de l'evenement
		 * renvoie à view.
		**/
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
							'tags'		=>	array(
												'link'		=> array(
																			'css/repetitions.css',
																	)
												)
							);

			$this->show('choristes/repetitions', ['data' => $data, 'layout'=> $layout ]);

		}


		/**
		 * AJAX : Va chercher dans la table calendrier tous les évenements.
		**/
		public function event(){

			$calendarManager = new \Manager\CalendarsManager();
			
			echo json_encode($calendarManager->findAll());

		}

		/**
		 * Recupere les users, ordonnés par pupitre ( tenor, alto , etc ... )
		 * Renvoi à view.
		**/
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
							'options'	=> 	$options,
							'tags'		=>	array(
												'link'		=> array(
																			'css/membres.css',
																	),
												'script'	=> array(
																			'js/membres.js',
																	),
												
											),
							);



			$this->show('choristes/membres', ['data' => $data, 'layout'=> $layout ]);

		}

		/**
		 * Modification du user coté utilisateur.
		 * @return envoi à view.
		**/
		public function userAccount(){

			$data = array();
			$options = $this->getOptions();
			$user = $this->getuser();
			$layout = array(
							'name'	=> 'useraccount',
							'user'		=>	$user,
							'options'	=> 	$options,
							'tags'		=>	array(
												'link'		=> array(
																			'css/modify.css',
																	),
											)
						);

			$usersManager = new \Manager\UsersManager();
			$user = $this->getUser();
			$id = $user['id'];


			if(isset($_POST['sentmail'])){

				$forUpdate = array('email' => $_POST['email']);

				$_SESSION['user']['email'] = $_POST['email'];

				$usersManager->update($forUpdate, $id);
			}

			if(isset($_POST['senttel'])){

				$forUpdate = array('tel' => $_POST['tel']);

				$_SESSION['user']['tel'] = $_POST['tel'];

				$usersManager->update($forUpdate, $id);
			}

			if(isset($_POST['sentpass'])){

				$thisUser = $usersManager->find($id);

				if(password_verify($_POST['password'], $thisUser['password']) && $_POST['newpass'] == $_POST['checkpass']){

					$newpass = password_hash($_POST['newpass'], PASSWORD_DEFAULT);

					$forUpdate = array('password' => $newpass);

					$_SESSION['user']['password'] = $_POST['newpass'];

					$usersManager->update($forUpdate, $id);
				}
			}

			if(isset($_POST['sentimage'])) { //Si on soumet le formulaire #image
				/* Upload images */

				$finfo = new \finfo(FILEINFO_MIME_TYPE);
				// Récupération du Mime
				$mimeType = $finfo->file($_FILES['image']['tmp_name']);

				$extFoundInArray = array_search(
			        $mimeType,
			        array(
			            'jpg' => 'image/jpeg',
			            'png' => 'image/png',
			        )
			    );

			    if ($extFoundInArray === false) { //Si le fichier envoyé n'est pas une image 
			    	echo 'Le fichier n\'est pas une image';
			    	//die();
			    }


			    //On renomme l'image et on l'envoie dans le bon dossier 
			    $path = '../public/assets/img/avatar/' .date('d-m-Y-h-i-s'). '.' . $extFoundInArray;
				$moved = move_uploaded_file($_FILES['image']['tmp_name'], $path);
				if(!$moved) {
					echo 'Erreur lors de l\'enregistrement';
				}
				
				//Insertion en base de données avec le fichier renommé et le bon chemin pour l'appel en FrontOffice
			    $path = '/img/avatar/' .date('d-m-Y-h-i-s'). '.' . $extFoundInArray;

			    $forUpdate = array('avatar' => $path);

				$usersManager->update($forUpdate, $id);	

				$layout['user']['avatar'] = $path;
				$_SESSION['user']['avatar']	= $path;
				
			}

			$this->show('choristes/modify', ['data' => $data, 'layout'=> $layout]);

		}


		/**
		 * Renvoie tous les enregistrements de la base documents pour les télécharger
		 * @return envoi à view documents.php
		**/
		public function getDocs() {

			$options = $this->getOptions();
			$user = $this->getuser();

			$docsManager = new \Manager\DocumentsManager;
			$docs = $docsManager->getAllDocs();


			$layout = array(
							'docs'		=>	$docs,
							'user'		=>	$user,
							'options'	=>	$options,
							'tags'		=>	array(
												'script'	=> array(
																			'js/contenu.js',
																	),
												
											),
						);

			$this->show('choristes/documents', ['layout'=> $layout ]);
		}


		public function membersManagement(){

			
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
							'options'	=>	$options,
							'tags'		=>	array(
												'link'		=> array(
																			'css/management.css',
																	),
												'script'	=> array(
																			'js/management.js',
																	),
												
											),
							);

			if(isset($_POST['sent'])){

				$usersManager = new \Manager\UsersManager();

				$newinfos = array(
						'email' => $_POST['email'], 
						'tel' => $_POST['tel'], 
						'role' => $_POST['role'],
					);

				$usersManager->update($newinfos, $_POST['id']);
			}


			$this->show('choristes/management', ['data' => $data, 'layout'=> $layout ]);
		}


		/**
		 * Renvoie un enregistrement de news spécifique donné en ID 
		 *@param table: table presse ou news passé en URL 
		 *@param id : ID de l'article ou de la news passée en URL 
		 * @return envoi à view [:table]/[:id].php
		**/
		public function getContentById($table, $id) {

			$options = $this->getOptions();
			$user = $this->getuser();
			$news= "";
			$Presses = "";
			
			if( $table == 'news' ){

				$newsById = new \Manager\NewsManager;
				$news = $newsById->getNewsById($id);

			} else if ($table == 'presses') {

				$PressesById = new \Manager\PressesManager;
				$Presses = $PressesById->getPressesById($id);

			}

			$layout = array(
							'name'		=>	'article',
							'table'     =>  $table,
							'id'		=>  $id,
							'user'		=>	$user,
							'options'	=>  $options,
							'tags'		=>	array(
												'script'	=> array(
																			'js/facebook.js',
																	),
											),
							);

			$data = array(
							'news'   => $news,
							'presses'=> $Presses,
							'id'	 => $id
				);

			$this->show('choristes/news', ['layout'=> $layout, 'data' => $data]);
		}

	}
