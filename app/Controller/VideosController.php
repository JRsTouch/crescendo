<?php

namespace Controller;

use \W\Controller\Controller;

class VideosController extends Controller{

	public function getAllVideos(){

		$videoManager = new \Manager\VideosManager();

		$videos = $videoManager->findAll();

		$layout = array(
						'ismain'	=>	false,
						'form'		=>	false,
						);
		$this->layout('layout',['layout'=> $layout, 'layout_data' => $data['options'] ]);

		$this->show('layout' , ['videos' => $videos ]);
	}
}