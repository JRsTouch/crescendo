<?php

namespace W\Controller;

use W\Security\AuthentificationManager;
use W\Security\AuthorizationManager;

/**
 * Le contrôleur de base à extender
 */
class Controller 
{

	/**
	 * Génère l'URL correspondant à une route nommée
	 * @param  string $routeName Le nom de route
	 * @param  array  $params    Tableau de paramètres optionnel de cette route
	 * @return  L'URL correspondant à la route
	 */
	public function generateUrl($routeName, array $params = array())
	{
		$app = getApp();
    	$router = $app->getRouter();
    	return $router->generate($routeName, $params);
	}

	/**
	 * Redirige vers une URI
	 * @param  string $uri URI vers laquelle rediriger
	 */
	public function redirect($uri)
	{
		header("Location: $uri");
		die();	
	}

	/**
	 * Redirige vers une route nommée
	 * @param  string $routeName Le nom de route vers laquelle rediriger
	 * @param  array  $params    Tableau de paramètres optionnel de cette route
	 */
	public function redirectToRoute($routeName, array $params = array())
	{
		$uri = $this->generateUrl($routeName, $params);
    	$this->redirect($uri);
	}


	/**
	 * Affiche un template
	 * 
	 * @param  string $file Chemin vers le template, relatif à app/templates/
	 * @param  array  $data Données à rendre disponibles à la vue
	 */
	public function show($file, array $data = array())
	{
		//incluant le chemin vers nos templates
		$engine = new \League\Plates\Engine('../app/templates');

		//charge nos extensions (nos fonctions personnalisées)
		$engine->loadExtension(new \W\View\Plates\PlatesExtensions());

		//rend certaines données disponibles à tous les templates
		//accessible avec $w_user dans les fichiers de vue
		$engine->addData(
			array(
				"w_user" => $this->getUser()
			)
		);

		//retire l'éventuelle extension .php
		$file = str_replace(".php", "", $file);

		// Affiche le template
		echo $engine->render($file, $data);
		die();
	}

	/**
	 * Affiche une page 403
	 */
	public function showForbidden()
	{
		header('HTTP/1.0 403 Forbidden');

		$file = '../app/templates/w_errors/403.php';
		if (file_exists($file)){
			$this->show('w_errors/403');
		}
		else {
			die("403");
		}
	}

	/**
	 * Affiche une page 404
	 */
	public function showNotFound()
	{
		//@todo 404
		header('HTTP/1.0 404 Not Found');

		$file = '../app/templates/w_errors/404.php';
		if (file_exists($file)){
			$this->show('w_errors/404');
		}
		else {
			die("404");
		}	
	}

	/**
	 * Récupère l'utilisateur actuellement connecté
	 */
	public function getUser()
	{
		$authenticationManager = new AuthentificationManager();
		$user = $authenticationManager->getLoggedUser();
		return $user;
	}

	/**
	 * Autorise l'accès à un ou plusieurs rôles
	 * 		
	 * @param  mixed $roles Tableau de rôles, ou chaîne pour un seul
	 */
	public function allowTo($roles)
	{
		if (!is_array($roles)){
			$roles = [$roles];
		}
		$authorizationManager = new AuthorizationManager();
		foreach($roles as $role){
			if ($authorizationManager->isGranted($role)){
				return true;
			}
		}

		$this->showForbidden();
	}


	/**
	 * Retourne une réponse JSON au client
	 * @param  mixed $data Les données à retourner
	 */
	public function showJson($data)
	{
		header("Content-type: application/json");
		$json = json_encode($data, JSON_PRETTY_PRINT);
		if ($json){
			die($json);
		}
		else {
			die("error in json encoding");
		}
	}

}