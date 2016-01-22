<?php

	namespace Controller;
 
	use \W\Controller\Controller;

	class UsersController extends Controller
	{

		/**
		* Login de l'utilisateur
		* Affichage de la page des choriste
		**/

		public function login(){


			$userLogin = new \W\Security\AuthentificationManager;

			if($this->getuser() != NULL){
				$this->redirectToRoute('choristes_home'); // si l'utilisateur est deja connecté on le renvoi vers le coin des choristes
			}

			if(isset($_POST['sent'])){ // si il n'est pas connecté il arrive sur le formulaire de connexion ou il renseigne mail et mdp

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


		/**
		* Enregistrement d'un utilisateur
		* @param array contenant les informations renseigné dans le formulaire
		**/

		public function register(){

			$usersManager = new \manager\UsersManager();

			if(isset($_POST['sent'])){ // a la soumission du formulaire on insert les nouvelles données en BDD table user

				$newUser = array(
					'username' => $_POST['fname'].' '.$_POST['lname'],
					'email' => $_POST['email'],
					'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
					'pupitre' => $_POST['pupitre'],

				);

				if($_POST['tel'] != ''){
					$newUser['tel'] = $_POST['tel'];
				}

				$usersManager->insert($newUser);

				$this->show('default/tobevalidate');
			}

			$this->show('default/inscription');


		}


		/**
		* Deconnexion de l'utilisateur
		* Affichage de la page home
		**/

		public function logOut(){

			$user = new \W\Security\AuthentificationManager();
			$user->logUserOut();

			$this->redirectToRoute('home');
		}
		

		public function toBeValidate(){


		} 

		

	}
