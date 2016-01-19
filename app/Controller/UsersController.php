<?php

	namespace Controller;
 
	use \W\Controller\Controller;

	class UsersController extends Controller
	{

		public function login(){


			$userLogin = new \W\Security\AuthentificationManager;

			if($this->getuser() != NULL){
				$this->redirectToRoute('choristes_home');
			}

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


		public function register(){

			$usersManager = new \manager\UsersManager();

			if(isset($_POST['sent'])){

				$newUser = array(
					'username' => $_POST['fname'].' '.$_POST['lname'],
					'email' => $_POST['email'],
					'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
					'pupitre' => $_POST['pupitre']
				);

				$usersManager->insert($newUser);

				$this->show('default/tobevalidate');
			}

			$this->show('default/inscription');


		}

		public function logOut(){

			$user = new \W\Security\AuthentificationManager();
			$user->logUserOut();

			$this->redirectToRoute('home');
		}

		public function toBeValidate(){


		} 

	}
