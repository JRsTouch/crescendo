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
		$this->show('default/home');
	}

	public function getHeader() {
		$manager = new \Manager\OptionsManager();
		$header = $manager->getBDDheader();
		//$this->show('default/header', ['header' => $header]);
		return $header;
	}

}