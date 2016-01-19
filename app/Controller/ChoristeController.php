<?php

	namespace Controller;
 
	use \W\Controller\Controller;

	class ChoristeController extends Controller
	{
		/**
		 * Page d'accueil du coin choriste
		 */
		public function home()
		{
			echo "plop";
			$this->show('choriste/home');
		}
	}
