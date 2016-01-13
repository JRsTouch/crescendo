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
		$data['header'] = getHeader();
		$data['options'] = getOptions();
		$data['actus'] = getActus();
		$data['videos'] = getVideos();
		$data['pictures'] = getPictures();

		$this->show('default/home' , ['data' => $data ]);

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

		return $actusTable;

	}
	
	public function getHeader()
	{
		$manager = new \Manager\OptionsManager();
		$header = $manager->getBDDheader();
		//$this->show('default/header', ['header' => $header]);
		return $header;

	}

}