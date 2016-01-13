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
		$optionsManager = new \Manager\OptionsManager();
		$options = $optionsManager->findAll();

		$this->show('default/home', ['options' => $options]);
	}

}