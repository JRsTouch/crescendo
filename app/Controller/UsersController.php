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
				$this->redirectToRoute('choristes_actus'); // si l'utilisateur est deja connecté on le renvoi vers le coin des choristes
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

					$this->redirectToRoute('choristes_actus');
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

		public function reset(){

			$usersManager = new \W\Manager\UserManager();
			$tokensManager = new \Manager\TokensManager();
			$newToken = new \W\Security\StringUtils();

			$layout = array(
						'ismain'	=>	false,
						'form'		=>	false,
						);

			if(isset($_POST['sent'])){
				if($usersManager->emailExists($_POST['email'])){

					$token = $newToken->randomString();
					$email = $_POST['email'];

					if($tokensManager->findEmail($_POST['email'])) {

						$toInsert = array(
								'token' => $token,
							);

						$tokensManager->updateFromEmail($toInsert, $_POST['email']);

					}else{						

						$toInsert = array(
								'email' => $email,
								'token' => $token,
							);

						$tokensManager->insert($toInsert);

					}
					
					echo "<p>Un email vous a été envoyé pour réinitialiser vôtre mot de passe</p>";
					echo '<a href="/">Retour a l\'accueil</a>';
				
					$message = 	'<p>Voici le lien pour réinitialiser vôtre mot de passe</p>'
								.'<br>'
								.'<a href="http://www.crescendo.site/newpass/'.$token.'">réinitialiser mon mot de passe</a>';
									
				    $to      = $email;
				    $subject = 'CrescendO : Réinitialisation du mot de passe.';
				    $message = $message;
				    $headers = 'From: service@crescendo.site' . "\r\n" .
				    'Reply-To: service@crescendo.site' . "\r\n" .
				    'X-Mailer: PHP/' . phpversion();

				    mail($to, $subject, $message, $headers);					

				}else{
					echo "<p>L'email renseigné n'existe pas.</p>";
				}
			}

			$this->show('choristes/resetPass', ['layout' => $layout]);
			
		}

		public function newPass($token){

			$layout = array(
						'ismain'	=>	false,
						'form'		=>	false,
						);

			$tokensManager = new \Manager\TokensManager();

			$user = $tokensManager->findToken($token);

			$usersManager = new \Manager\UsersManager();

			if($user){

				if(isset($_POST['sent'])){

					if($_POST['newpass'] == $_POST['checkpass'] && strlen($_POST['newpass']) >= 5){

						$newpassword = array(
								'password' => password_hash($_POST['newpass'], PASSWORD_DEFAULT),
							);

						$usersManager->updateFromEmail($newpassword ,$user['email']);

						$tokensManager->delete($user['email']);

						$this->redirectToRoute('users_login');

					}else{

						if($_POST['newpass'] != $_POST['checkpass']){
							echo '<p>Les deux mots de passe doivent être identiques.</p>';
						}

						if(strlen($_POST['newpass']) < 5){
							echo '<p>Le mot de passe doit contenir minimum 5 caractères.</p>';
						}

					}
					
				}
			}else{

				$this->redirectToRoute('home');

			}

			$this->show('choristes/newPass', ['layout' => $layout]);

		}

		

	}
