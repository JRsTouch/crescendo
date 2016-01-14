<?php

namespace Controller;

use \W\Controller\Controller;

class DefaultController extends Controller
{

	/**
	 * Page d'accueil par défaut
	 */
	public function home()
	{

		$data = array();
		$data['options'] = $this->getOptions();
		$data['actus'] = $this->getActus();
		$data['videos'] = $this->getVideos();
		$data['images'] = $this->getImages();

		$this->show('default/home' , ['data' => $data ]);

	}

	public function getOptions()
	{

		$optionsManager = new \Manager\OptionsManager();
		$options = $optionsManager->findAll();

		return $options;

	}

	public function getVideos()
	{

		$videosManager = new \Manager\VideosManager();
		$video = $videosManager->findLimit(3);

		return $video;
	
	}

	public function getImages(){

		$imagesManager = new \Manager\ImagesManager();
		$images = $imagesManager->getLastImages();

		return $images;

	}

	public function getActus()
	{
		$newsManager = new \Manager\NewsManager();
		$presseManager = new \Manager\PresseManager();

		$news = $newsManager->getLastNews();
		$presse = $presseManager->getLastPresse();

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
	
	public function getHeader()
	{
		$manager = new \Manager\OptionsManager();
		$header = $manager->getBDDheader();
		//$this->show('default/header', ['header' => $header]);
		return $header;

	}

	public function presentation(){
		$data = array();
		$data['options'] = $this->getOptions();
		$optionsmanager = new \Manager\OptionsManager();
		$options = $optionsmanager->findAll();

		$this->show('default/presentation', ['data' => $data]);
	}

	public function presse() {
		$presseManager = new \Manager\PresseManager();
		$articles = $presseManager->getAllPresse();
		$this->show('default/presse', ['articles' => $articles]);
	}

	public function contact(){
	  
		# récupération des paramètres
		$name = isset($_POST['name']) ? $_POST['name'] : ''; // champs name
		$email = isset($_POST['email']) ? $_POST['email'] : ''; // champs email
		$message = isset($_POST['message']) ? $_POST['message'] : ''; // champs message
		  
		# variables
		$errors = []; // erreurs du script
		$success = false; // est ce qu'il y'a une erreur ?
		$min_characters = 50; // nombre de caractères minimum pour le champs messag
		# traitement
		  
		// suppression des espaces autour des chaînes
		$name = trim($name);
		$email = trim($email);
		$message = trim($message);
		  
		// suppression des retours à la lignes dans le message
		$message = preg_replace("#\n|\t|\r#",'',$message);
		  
		if( $name == '' ){ $errors['name'] = "Le champs nom est requis"; }
		if( filter_var($email, FILTER_VALIDATE_EMAIL) == false ){ $errors['email'] = "L'email saisi n'est pas valide"; }
		if( strlen($message)<$min_characters ){ $errors['message'] = "La longueur du message doit être supérieure à ".$min_characters." caractères"; }

		# si le tableau $errors est vide, alors l'opération est un success
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

}