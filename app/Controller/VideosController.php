<?php

namespace Controller;

use \W\Controller\Controller;

class VideosController extends Controller{

	public function getAllVideos(){

		$videoManager = new \Manager\VideosManager();

		$videos = $videoManager->findAll();

		$this->show('default/videos' , ['videos' => $videos ]);
	}
}