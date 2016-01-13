<?php

namespace W\View\Plates;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

/**
 * @link http://platesphp.com/engine/extensions/ Documentation Plates
 */
class PlatesExtensions implements ExtensionInterface
{
	/**
	 * Enregistre les nouvelles fonctions dans Plates
     * @param \League\Plates\Engine $engine L'instance du moteur de template
	 */
    public function register(Engine $engine)
    {
        $engine->registerFunction('assetUrl', [$this, 'assetUrl']);
        $engine->registerFunction('url', [$this, 'generateUrl']);
    }

    /**
     * Retourne l'URL relative d'un asset
     * @param string $path Le chemin vers le fichier, relatif à public/assets/
     * @return  string L'URL relative vers le fichier
     */
    public function assetUrl($path)
    {
        $app = getApp();
        return $app->getConfig('base_url') . '/assets/' . ltrim($path, '/');
    }

    /**
     * Retourne l'URL absolue d'une route nommée
     * @param  string $routeName Le nom de la route pour laquelle générer une URL
     * @param  array $params Un tableau de paramètres requis pour générer l'URL
     * @return  string L'URL absolue
     */
    public function generateUrl($routeName, array $params = array())
    {
    	$app = getApp();
    	$router = $app->getRouter();
    	return $router->generate($routeName, $params);
    }
}
