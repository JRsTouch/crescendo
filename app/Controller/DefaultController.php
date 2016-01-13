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

		$this->show('default/home', ['data' => $data]);
	}

	public function getOptions(){

		$optionsManager = new \Manager\OptionsManager();
		$options = $optionsManager->findAll();

		return $options;
	}

}