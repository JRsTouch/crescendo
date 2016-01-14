<?php

namespace Controller;

use \W\Controller\Controller;

class ImagesController extends Controller{

	public function getAllImages(){

		$imagesManager = new \Manager\ImagesManager();

		$images = $imagesManager->findAll();

		$this->show('default/images' , ['images' => $images ]);
	}
}