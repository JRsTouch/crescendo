<?php

	namespace Controller;
 
	use \W\Controller\Controller;

	class ChoristesController extends Controller
	{
		/**
		 * Page d'accueil du coin choriste
		 */

		
		public function home()
		{
			
			$data = array();
			$data['options'] = $this->getOptions();
			$layout = array();
			$this->show('choristes/home',['data' => $data, 'layout'=> $layout ]);
		}

		public function getOptions(){

			$optionsManager = new \Manager\OptionsManager();
			$options = $optionsManager->findAll();
			$options[0]['copyrights']=explode(';',$options[0]['copyrights']);

			
			return $options;
		}

		public function Ajout() {
			
			$this->show('choristes/ajout_news');
		}
	}
