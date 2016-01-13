<?php

namespace W\Security;

use W\Security\StringUtils;
use W\Manager\UserManager;

class AuthentificationManager
{

	/**
	 * Vérifie qu'une combinaison d'email/username et mot de passe (en clair) sont présents en bdd et valides
	 * @param  string $usernameOrEmail Le pseudo ou l'email à test
	 * @param  string $plainPassword Le mot de passe en clair à tester
	 * @return  int  0 si invalide, l'identifiant de l'utilisateur si valide
	 */
	public function isValidLoginInfo($usernameOrEmail, $plainPassword)
	{

		$app = getApp();

		$userManager = new UserManager();
		$usernameOrEmail = strip_tags(trim($usernameOrEmail));
		$foundUser = $userManager->getUserByUsernameOrEmail($usernameOrEmail);
		if (!$foundUser){
			return 0;
		}

		if (password_verify($plainPassword, $foundUser[$app->getConfig('security_password_property')])){
			return (int) $foundUser[$app->getConfig('security_id_property')];
		}

		return 0;
	}

	/**
	 * Connecte un utilisateur
	 * @param  array $user Le tableau contenant les données utilisateur
	 */
	public function logUserIn($user)
	{
		$app = getApp();

		//retire le mot de passe de la session
		unset( $user[$app->getConfig('security_password_property')] );
		$_SESSION["user"] = $user;
	}

	/**
	 * Déconnecte un utilisateur
	 */
	public function logUserOut()
	{
		unset($_SESSION["user"]);
	}

	/**
	 * Retourne les données présente en session sur l'utilisateur connecté
	 * @return  mixed Le tableau des données utilisateur, null si non présent
	 */
	public function getLoggedUser()
	{
		return (isset($_SESSION["user"])) ? $_SESSION['user'] : null;
	}

	

	/**
	 * Utilise les données utilisateurs présentes en base pour mettre à jour les données en session
	 * @return  boolean
	 */
	public function refreshUser()
	{
		$app = getApp();
		$userManager = new UserManager();
		$userManager->setTable( $app->getConfig('security_user_table') );
		$userFromSession = $this->getLoggedUser();
		if ($userFromSession){
			$userFromDb = $userManager->find($userFromSession[$app->getConfig('security_id_property')]);
			if ($userFromDb){
				$_SESSION["user"] = $userFromDb;
				return true;
			}
		}

		return false;
	}
}