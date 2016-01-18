<?php

	namespace Controller;
 
	use \W\Controller\Controller;

	class UsersController extends Controller
	{

		public function login(){


			$userLogin = new \W\Security\AuthentificationManager;

			if(isset($_POST['sent'])){

				$login = $_POST['login'];
				$password = $_POST['password'];


				$id = $userLogin->isValidLoginInfo($login, $password);

				if($id){

					$findUser = new \Manager\UsersManager();
					$user = $findUser->find($id);

					$userLogin->logUserIn($user);
					
					$this->getUser();

					$this->redirectToRoute('choristes_home');
				}

			}


			$this->show('default/login');
		}
	}
