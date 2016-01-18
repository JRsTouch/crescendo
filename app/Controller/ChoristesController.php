<?php

	namespace Controller;
 
	use \W\Controller\Controller;

	class ChoristesController extends Controller
	{

		public function __construct(){
		
			$this->allowTo(['admin', 'user']);

		}

		public function home()
		{
			echo "plop";
			$this->show('choristes/home');
		}

	}
