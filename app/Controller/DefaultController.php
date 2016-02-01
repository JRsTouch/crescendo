<?php

namespace Controller;

use \W\Controller\Controller;

class DefaultController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */

	public function home(){


		$data = array();
		$data['options'] = $this->getOptions(); 
		$data['actus'] = $this->getActus(); //Actus presse et news
		$data['videos'] = $this->getVideos(); //Contenu du flexslider video
		$data['images'] = $this->getImages(); //Contenu du flexslider image 
		$layout = array(
						'name'		=>	'home',
						'opengraph' =>	array(
												'title'			=>	'CrescendO Joeuf: Accueil',
												'type'			=>	'website',
												'image'			=>	$data['options'][0]["url_logo"],
												'url'			=>	'http://www.crescendo.site',
												'description'	=>	'Découvrez la chorale Pop-Rock CrescendO, de Joeuf(54), Actus, Concerts, Vidéos...',
												'locale'		=>	'fr_FR',
											),
						'tags'		=>	array(
												'link'		=> array(
																			'css/flexslider.css',
																			'css/home.css',
																			'css/mobile_landscape.css',
																			'css/mobile_portrait.css',
																	),
												'script'	=> array(
																			'js/jquery.flexslider.js',
																			'js/javascript.js',
																	),
												
											),
						);
		$this->show('default/home' , ['data' => $data, 'layout'=> $layout ] );
	}


	/**
	 * Va chercher les options dans la BDD * 
	 * @return options (array)
	 **/
	public function getOptions(){

		$optionsManager = new \Manager\OptionsManager();
		$options = $optionsManager->findAll();
		//$options['copyrights'] = explode(";", $options['copyrights']);
		$options[0]['copyrights']=explode(';',$options[0]['copyrights']);

		
		return $options;
	}


	/**
	 * Va chercher les urls des vidéos YouTube dans la BDD 
	 * @return options (array)
	 **/
	public function getVideos(){

		$videosManager = new \Manager\VideosManager();
		$video = $videosManager->findLimit(3);

		return $video;
	}


	/**
	 * Va chercher les images dans la BDD  
	 * @return images (array)
	 **/
	public function getImages(){
		$imagesManager = new \Manager\ImagesManager();
		$images = $imagesManager->getLastImages();

		return $images;
	}


	/**
	 * Va chercher les Actus dans la base presses ET la base news et les retourne par ordre chronologique décroissant 
	 * @return actusTable (array)
	 **/
	public function getActus(){
		$newsManager = new \Manager\NewsManager();
		$pressesManager = new \Manager\PressesManager();

		$news = $newsManager->getLastNews();
		$presse = $pressesManager->getLastPresses();

		$actusTable = array();

			foreach ($news as $index => $content) {
				array_push($actusTable,$content);
			}

			foreach ($presse as $index => $content) {
				array_push($actusTable,$content);
			}

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


		$actusTable = array_sort($actusTable,'date');

		$actusTable = array_reverse ($actusTable);

		return $actusTable;
	}


	/**
	 * Va chercher les options (enregistrements uniques) dans la BDD  
	 * Pour les intégrer au Layout de la FrontPage
	 **/
	public function presentation(){
		$data = array();
		$data['options'] = $this->getOptions();
		$optionsmanager = new \Manager\OptionsManager();
		$options = $optionsmanager->findAll();
		$layout = array(
						'name'		=>	'presentation',
						'opengraph' =>	array(
												'title'			=>	'CrescendO Joeuf: Présentation',
												'type'			=>	'website',
												'image'			=>	$data['options'][0]["url_logo"],
												'url'			=>	'http://www.crescendo.site/presentation',
												'description'	=>	'Présentation de la chorale Pop-Rock CrescendO, de Joeuf(54), Actus, Concerts, Vidéos...',
												'locale'		=>	'fr_FR',
												'site_name'		=>	'CrescendO',
											),
						'tags'		=>	array(
												'link'		=> array(
																			'css/home.css',
																			'css/presentation.css'
																	),
												'script'	=> array(
																			
																	),
											),
						);

		$this->show('default/presentation', ['data' => $data, 'layout' => $layout]);
	}


	/**
	 * Va chercher tous les articles de presse  dans la BDD ainsi que les options 
	 * Pour les intégrer au Layout de la page "presse" - options dans le footer
	 **/
	public function presse() {
		$data = array();
		$data['options'] = $this->getOptions();
		$presseManager = new \Manager\PressesManager();
		$articles = $presseManager->getAllPresses();
		$newsManager = new \Manager\NewsManager();
		$news = $newsManager->getAllNews();
		$actus = array();

			foreach ($news as $index => $content) {
				array_push($actus,$content);
			}

			foreach ($articles as $index => $content) {
				array_push($actus,$content);
			}

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


		$actus = array_sort($actus,'date');

		$actus = array_reverse ($actus);

		$layout = array(
				'name'		=>	'presse',
				'opengraph' =>	array(
										'title'			=>	'CrescendO Joeuf: Présentation',
										'type'			=>	'article',
										'image'			=>	$data['options'][0]["url_logo"],
										'url'			=>	'http://www.crescendo.site/presse',
										'description'	=>	'Revue de presse de la chorale Pop-Rock CrescendO, de Joeuf(54).',
										'locale'		=>	'fr_FR',
										'site_name'		=>	'CrescendO',
									),
				'tags'		=>	array(
										'link'		=> array(
																			'css/medias.css',
																	),
										'script'	=> array(
																			'js/ajax.js',
																	),
									),
				);
		$this->show('default/presse', ['articles' => $actus, 'data' => $data, 'layout' => $layout]);
	}


	/**
	 * Gestion du formulaire de contact  
	 **/
	public function contact(){
	  
		// récupération des paramètres
		$name = isset($_POST['name']) ? $_POST['name'] : ''; // champs name
		$email = isset($_POST['email']) ? $_POST['email'] : ''; // champs email
		$message = isset($_POST['message']) ? $_POST['message'] : ''; // champs message
		  
		// variables
		$errors = []; // erreurs du script
		$success = false; // est ce qu'il y'a une erreur ?
		$min_characters = 50; // nombre de caractères minimum pour le champs messag
		// traitement
		  
		// suppression des espaces autour des chaînes
		$name = trim($name);
		$email = trim($email);
		$message = trim($message);
		  
		// suppression des retours à la lignes dans le message
		$message = preg_replace("#\n|\t|\r#",'',$message);
		  
		if( $name == '' ){ $errors['name'] = "Le champs nom est requis"; }
		if( filter_var($email, FILTER_VALIDATE_EMAIL) == false ){ $errors['email'] = "L'email saisi n'est pas valide"; }
		if( strlen($message)<$min_characters ){ $errors['message'] = "La longueur du message doit être supérieure à ".$min_characters." caractères"; }

		// si le tableau $errors est vide, alors l'opération est un success
		if( count($errors) == 0 ){
		    $success = true;

		    $to      = 'julienraletz@gmail.com';
		    $subject = $name;
		    $message = $message;
		    $headers = 'From: '.$email . "\r\n" .
		    'Reply-To: '.$email . "\r\n" .
		    'X-Mailer: PHP/' . phpversion();

		    mail($to, $subject, $message, $headers);
		    
		}

		# fin du script
		$result = ["success"=>$success,"errors"=>$errors];
		echo json_encode($result);
	}


	/**
	 * Va chercher tous les liens de vidéos  dans la BDD ainsi que les options 
	 * Pour les intégrer au Layout de la page "vidéos" - options dans le footer
	 **/
	public function getAllVideos(){

		$videoManager = new \Manager\VideosManager();
		$videos = $videoManager->findAll();
		$data = array();
		$data['options'] = $this->getOptions();
		$layout = array(
						'name'		=>	'videos',
						'opengraph' =>	array(
												'title'			=>	'CrescendO Joeuf: Vidéos',
												'type'			=>	'article',
												'image'			=>	$data['options'][0]["url_logo"],
												'url'			=>	'http://www.crescendo.site',
												'description'	=>	'Vidéos de concert de la chorale Pop-Rock CrescendO, de Joeuf(54).',
												'locale'		=>	'fr_FR',
												'site_name'		=>	'CrescendO',
											),
						'tags'		=>	array(
										'link'		=> array(
																			'css/medias.css',
																	),
										'script'	=> array(
																			'js/ajax.js',
																	),
									),
						);

		$this->show('default/videos' , ['videos' => $videos, 'data' => $data, 'layout' => $layout ]);
	}


	/**
	 * Va chercher tous les liens d'images de la chorale  dans la BDD ainsi que les options 
	 * Pour les intégrer au Layout de la page "images" - options dans le footer
	 **/
	public function getAllImages(){

		$imagesManager = new \Manager\ImagesManager();

		$images = $imagesManager->findAll("id", "DESC");
		$data = array();
		$data['options'] = $this->getOptions();
		$layout = array(
						'name'		=>	'images',
						'opengraph' =>	array(
												'title'			=>	'CrescendO Joeuf: Galerie Photos',
												'type'			=>	'article',
												'image'			=>	'assets/'.$images[0]['url'],
												'url'			=>	'http://www.crescendo.site/images',
												'description'	=>	'Visitez la galerie de photos de la chorale Pop-Rock CrescendO, de Joeuf(54).',
												'locale'		=>	'fr_FR',
												'site_name'		=>	'CrescendO',
											),
						'tags'		=>	array(
												'link'		=> array(
																			'css/medias.css',
																	),
												'script'	=> array(
																			'js/ajax.js',
																	),
									),
						);

		$this->show('default/images' , ['images' => $images, 'data' => $data, 'layout' => $layout ]);
	}

	/**
	 * Renvoie un enregistrement de news spécifique donné en ID 
	 *@param table: table presse ou news passé en URL 
	 *@param id : ID de l'article ou de la news passée en URL 
	 *@return envoi à view [:table]/[:id].php
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
							'table'     =>  $table,
							'id'		=>  $id,
							'user'		=>	$user,
							'options'	=>  $options,
							'name'		=>	'images',
							'opengraph' =>	array(
												'title'			=>	'CrescendO Joeuf: Galerie Photos',
												'type'			=>	'article',
												'image'			=>	$options[0]["url_logo"],
												'url'			=>	'http://www.crescendo.site/images',
												'description'	=>	'Visitez la galerie de photos de la chorale Pop-Rock CrescendO, de Joeuf(54).',
												'locale'		=>	'fr_FR',
												'site_name'		=>	'CrescendO',
											),
							'tags'		=>	array(
												'link'		=> array(
																			'css/medias.css',
																	),
												'script'	=> array(
																			'js/ajax.js',
																	),
									),
							);

			$data = array(
							'news'   => $news,
							'presses'=> $Presses,
							'id'	 => $id
				);

			$this->show('default/news', ['layout'=> $layout, 'data' => $data]);
		}

}