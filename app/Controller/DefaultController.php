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
		$data['actus'] = $this->getActus();
		$data['videos'] = $this->getVideos();
		$data['images'] = $this->getImages();
		$layout = array(
						'ismain'	=>	true,
						'form'		=>	true,
						);
		$this->show('default/home' , ['data' => $data, 'layout'=> $layout ] );
	}

	public function getOptions(){

		$optionsManager = new \Manager\OptionsManager();
		$options = $optionsManager->findAll();
		//$options['copyrights'] = explode(";", $options['copyrights']);
		$options[0]['copyrights']=explode(';',$options[0]['copyrights']);

		
		return $options;
	}

	public function getVideos(){

		$videosManager = new \Manager\VideosManager();
		$video = $videosManager->findLimit(3);

		return $video;
	}

	public function getImages(){
		$imagesManager = new \Manager\ImagesManager();
		$images = $imagesManager->getLastImages();

		return $images;
	}

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

	public function presentation(){
		$data = array();
		$data['options'] = $this->getOptions();
		$optionsmanager = new \Manager\OptionsManager();
		$options = $optionsmanager->findAll();
		$layout = array(
						'ismain'	=>	false,
						'form'		=>	true,
						);

		$this->show('default/presentation', ['data' => $data, 'layout' => $layout]);
	}

	public function presse() {
		$data = array();
		$data['options'] = $this->getOptions();
		$presseManager = new \Manager\PressesManager();
		$articles = $presseManager->getAllPresses();
		$layout = array(
						'ismain'	=>	false,
						'form'		=>	false,
						);
		$this->show('default/presse', ['articles' => $articles, 'data' => $data, 'layout' => $layout]);
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

	public function getAllVideos(){


		$videoManager = new \Manager\VideosManager();
		$videos = $videoManager->findAll();
		$data = array();
		$data['options'] = $this->getOptions();
		$layout = array(
						'ismain'	=>	false,
						'form'		=>	false,
						);

		$this->show('default/videos' , ['videos' => $videos, 'data' => $data, 'layout' => $layout ]);
	}

	public function getAllImages(){

		$imagesManager = new \Manager\ImagesManager();

		$images = $imagesManager->findAll();
		$data = array();
		$data['options'] = $this->getOptions();
		$layout = array(
						'ismain'	=>	false,
						'form'		=>	false,
						);

		$this->show('default/images' , ['images' => $images, 'data' => $data, 'layout' => $layout ]);
	}

}