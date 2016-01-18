<?php 

	namespace Controller;
 
	use \W\Controller\Controller;

	class ActusController extends Controller
	{
		public function Ajout(/*$description, $titre, $alt_img*/) {
			$this->show('choristes/ajout_news');

		}
	}
