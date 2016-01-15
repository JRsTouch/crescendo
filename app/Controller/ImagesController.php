<?php

namespace Controller;

use \W\Controller\Controller;

class ImagesController extends Controller{

	public function getAllImages(){

		$imagesManager = new \Manager\ImagesManager();

		$images = $imagesManager->findAll();
		$layout = array(
						'ismain'	=>	false,
						'form'		=>	false,
						);
		$this->layout('layout',['layout'=> $layout, 'layout_data' => $data['options'] ]);

		$this->show('layout' , ['images' => $images ]);
	}
}